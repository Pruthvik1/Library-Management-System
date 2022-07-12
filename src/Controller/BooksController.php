<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

     //all_books.php
     public function allBooks($id=null){
     //fetch loggedin user
    if($this->request->getAttribute('identity')){ 
     $Users = $this->fetchTable('Users');
     $uid = $this->request->getAttribute('identity')->getIdentifier();
     $user = $Users->get($uid);
     $this->set(compact('user'));
    }
    //categories
    $Cats=$this->fetchTable('Categories');
    $cats=$Cats->find()->all();
    $this->set(compact('cats'));
    //books
    if($id==null){
    $books = $this->Books->find()->contain('Categories')->all();
   }else{
    $books = $this->Books->find()->contain('Categories')->where(['category_id'=>$id])->all();
    $cat=$Cats->get($id);
    $this->set(compact('cat'));

   }
    $this->set(compact('books'));
     }
     public function index()
    {
        $Users = $this->fetchTable('Users');
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $this->set(compact('user'));

        $this->paginate = [ 'contain' => 'Categories', ];
        $books = $this->paginate($this->Books);
        $this->set(compact('books'));
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $Users = $this->fetchTable('Users');
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $this->set(compact('user'));

        $book = $this->Books->get($id, [
            'contain' => ['Categories', 'Records'],
        ]);

        $this->set(compact('book'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Users = $this->fetchTable('Users');
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $this->set(compact('user'));
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {

            //$book = $this->Books->patchEntity($book, $this->request->getData());
            $img = $this->request->getData('book_img');

            $iname = $img->getClientFilename();

            $dest = 'img' . DS . $iname;
            $img->moveTo($dest);
            //setUser
            $book->category_id = $this->request->getData('category_id');
            $book->title = $this->request->getData('title');
            $book->summary = $this->request->getData('summary');
            $book->isbn_no = $this->request->getData('isbn_no');
            $book->auther = $this->request->getData('auther');
            $book->total_qty = $this->request->getData('total_qty');
            $book->available_qty = $this->request->getData('available_qty');
            $book->book_img = $iname;
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $categories = $this->Books->Categories->find('list', ['limit' => 200])->all();
        $this->set(compact('book', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Users = $this->fetchTable('Users');
        $uid = $this->request->getAttribute('identity')->getIdentifier();
        $user = $Users->get($uid);
        $book = $this->Books->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //$book = $this->Books->patchEntity($book, $this->request->getData());
            $img = $this->request->getData('book_img');
            $iname = $img->getClientFilename();
            $dest = 'img' . DS . $iname;
            $img->moveTo($dest);
            //setbook
            $book->category_id = $this->request->getData('category_id');
            $book->title = $this->request->getData('title');
            $book->summary = $this->request->getData('summary');
            $book->isbn_no = $this->request->getData('isbn_no');
            $book->auther = $this->request->getData('auther');
            $book->total_qty = $this->request->getData('total_qty');
            $book->available_qty = $this->request->getData('available_qty');
            $book->book_img = $iname;
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $categories = $this->Books->Categories->find('list', ['limit' => 200])->all();
        $this->set(compact('book', 'categories','user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
