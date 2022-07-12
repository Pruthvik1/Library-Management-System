<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    //single_book.php when clicks on title
    public function singleBook($id = null)
    {
        //info of logged in user
        if ($this->request->getAttribute('identity')) {
            $uid = $this->request->getAttribute('identity')->getIdentifier();
            $user = $this->Users->get($uid);
            $this->set(compact('user'));
        }

        //book-record
        $Books = $this->fetchtable('Books');
        $book = $Books->get($id, [
            'contain' => ['Categories'],
        ]);
        $this->set(compact('book'));
    }
    //borrow-book
    public function borrowBook($id = null)
    {
        $this->autoRender = false;
        //fetch logged in user-id
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $this->Users->get($uid);
        $this->set(compact('user'));
        //fetch-book details
        $Books = $this->fetchtable('Books');
        $book = $Books->get($id, [
            'contain' => ['Records'],
        ]);

        //fetch-records-related-to-book_id as well as user_id
        $Records = $this->fetchTable('Records');
        //$records = $Records->find()->where(['book_id' => $id, 'user_id' => $uid]);

        //borrow-logic
        if ($book->available_qty > 0) {
            $record = $Records->find()->where(['book_id' => $id, 'user_id' => $uid, 'is_returned' => 'false'])->toList();

            $count = count($record);
            // print_r($count);
            //die;
            if (!$count) {
                $record = $Records->newEmptyEntity();
                //map book to record
                $record->book_name = $book->title;
                $record->book_id = $book->id;
                $record->user_id = $uid;
                $record->is_returned = 'false';
                $record->return_date = '-';
                //save record
                $Records->save($record);
                $book->available_qty = $book->available_qty - 1;
                $Books->save($book);

                $this->Flash->success('Happy learning!You borrowed '.$book->title.' Successfully');
                $this->redirect(['action' => 'myRecords']);
            } else {
                $this->Flash->error('You already borrowed '.$book->title.' and not retuned ');
                $this->redirect(['action' => 'myRecords']);
            }
        } else {
            $this->Flash->error($book->title.' book is not available');
            $this->redirect(['action' => 'singleBook', $id]);
        }
    }
    //return-book record_id=$id
    public function returnBook($id = null)
    {
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $this->Users->get($uid);
        $this->set(compact('user'));

        $Records = $this->fetchTable('Records');
        $Books = $this->fetchTable('Books');

        // $record = $Records->find()->where([ 'user_id' => $uid, 'is_returned' => 'false'])->toList();
        $record = $Records->get($id, ['where' => ['user_id' => $uid, 'is_returned' => 'false']]);
        $record->is_returned = 'true';
        $record->return_date = date('m/d/Y h:i:s a', time());;
        $bid = $record->book_id;
        //increment available_qty
        $book = $Books->get($bid);
        $book->available_qty += 1;
        $Books->save($book);


        if ($Records->save($record)) {
            $this->Flash->success(__('Yo returned '.$book->title.' sucessfully.'));
            return $this->redirect(['action' => 'home']);
        }
        $this->Flash->error(__('Error! Try after some time'));
        $this->redirect(['action' => 'myRecords']);
    }
    //users-record
    public function myRecords()
    {
        //fetch logged in user-id
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $this->Users->get($uid);
        $this->set(compact('user'));

        //fetch records of user

        $Records = $this->fetchTable('Records');
        $records = $this->paginate($Records->find()->where(['user_id' => $uid])->order(['id' => 'desc']));

        $this->set(compact('records'));
    }


    //landingpage-home
    public function home()
    {
        //fetches books
        $Books = $this->fetchTable('books');
        $books = $Books->find()->contain('Categories')->order(['created_at'=>'ASC'])->limit(4)->all();
        //fetch user from session
        $user = $this->Authentication->getIdentity('username');
        $connection = ConnectionManager::get('default');
        $pbooks = $connection->execute('SELECT books.id,books.category_id,books.book_img,books.title,books.slug,books.summary,books.isbn_no,books.auther,COUNT(records.book_id) AS count FROM books,records where books.id=records.book_id GROUP BY records.book_id ORDER BY COUNT DESC LIMIT 4')->fetchAll('assoc');
        $this->set(compact('user'));
        $this->set(compact('books'));
        $this->set(compact('pbooks'));
    }

    //login-page
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /books after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'users',
                'action' => 'home',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'home']);
    }

    //librians-list for admins
    public function librarian()
    {
        // $this->loadComponent('Paginator');
        $libs = $this->paginate($this->Users->find()->where(['role' => 'librarian']));
        $this->set(compact('libs'));
    }
    //students list for ads and libs
    public function student()
    {   //get logged-in user
        $id = $this->request->getAttribute('identity')->getIdentifier();
        $user = $this->Users->get($id);
        $this->set(compact('user'));

        $this->loadComponent('Paginator');
        $students = $this->Paginator->paginate($this->Users->find()->where(['role' => 'user'])->find('all'));
        $this->set(compact('students'));
    }
    // password-reset
    public function changePassword()
    {
        //fetch_user
        $id = $this->request->getAttribute('identity')->getIdentifier();
        $user = $this->Users->get($id);

        $passowrd_hash = $user->password;
        $current_password = $this->request->getData('o_pwd');
        $new_password = $this->request->getData('n_pwd');
        $confirm_password = $this->request->getData('c_pwd');

        if (password_verify($current_password, $passowrd_hash)) {
            if ($new_password == $confirm_password) {
                $user->password = $new_password;
                $this->Users->save($user);
                $this->Flash->success(__('Your Password Updated Successfully.'));
                $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->success(__('Please confirm your password.'));
                $this->redirect(['action' => 'profile', $user->id]);
            }
        } else {
            $this->Flash->success(__('You entered wrong password.Try again'));
            $this->redirect(['action' => 'profile', $user->id]);
        }
    }
    //profile
    public function profile($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        //profile-edit
        if ($this->request->is(['patch', 'post', 'put'])) {
            //img-save
            $img = $this->request->getData('profile_img');
            $iname = $img->getClientFilename();
            $dest = 'img' . DS . $iname;
            $img->moveTo($dest);
            //setUser
            $user->username = $this->request->getData('username');
            $user->role = $this->request->getData('role');
            $user->email = $this->request->getData('email');
            $user->profile_img = $iname;
            // $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your Data Updated Successfully.'));
                return $this->redirect(['action' => 'home']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    //show-records
    public function record($id = null)
    {
        $Records = $this->fetchTable('Records');
        // print_r($records);
        // die;
        $records = $this->paginate($Records->where(['user_id' => $id])->find('all'));
        $this->set(compact('records'));
    }
    public function index()
    {
        //get logged in user
        $Users = $this->fetchTable();
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $this->set(compact('user'));

        $usersV = $this->paginate($this->Users);
        $this->set(compact('usersV'));
    }
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //get logged in user
        $Users = $this->fetchTable();
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $this->set(compact('user'));
        $userV = $this->Users->get($id, [
            'contain' => ['Records'],
        ]);

        $this->set(compact('userV'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {    //get logged in user
        $Users = $this->fetchTable();
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $this->set(compact('user'));

        $userV = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {

            //img save to img/ folder
            $img = $this->request->getData('profile_img');

            $iname = $img->getClientFilename();

            $dest = 'img' . DS . $iname;
            $img->moveTo($dest);
            //setUser
            $userV->username = $this->request->getData('username');
            $userV->password = $this->request->getData('password');
            $userV->role = $this->request->getData('role');
            $userV->email = $this->request->getData('email');
            $userV->profile_img = $iname;
            //$user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($userV)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('userV'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //get logged in user
        $Users = $this->fetchTable();
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $this->set(compact('user'));

        $userV = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //img-save
            $img = $this->request->getData('profile_img');
            $iname = $img->getClientFilename();
            $dest = 'img' . DS . $iname;
            $img->moveTo($dest);
            //setUser
            $userV->username = $this->request->getData('username');
            $userV->password = $this->request->getData('password');
            $userV->role = $this->request->getData('role');
            $userV->email = $this->request->getData('email');
            $userV->profile_img = $iname;
            // $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($userV)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('userV'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
