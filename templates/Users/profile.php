<?= $this->Html->css('profile.css') ?>
<?= $this->Flash->render() ?>


<div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 " style="margin-left:110px ;">
        <div class="card h-100">
            <div class="card-body">
                <div class="account-settings">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <?= $this->Html->image($user['profile_img'],['style'=>'width:250px;height:290px']) ?>
                        </div>
                        <h2 class="user-name"><?= $user['username'] ?></h5>
                            <h2 class="user-email"><?= $user['email'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
        <div class="card h-100">
            <div class="card-body">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mb-2 text-primary">Personal Details</h6>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <?= $this->Form->label('Username') ?>
                            <?= $this->Form->text('username', ['class' => 'form-control', 'placeholder' => "Enter full name"]) ?>
                        </div>
                    </div>
                 
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <?= $this->Form->control('email', ['type' => 'email', 'class' => 'form-control', 'placeholder' => "Enter email ID"]) ?>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Profile</h6>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <?= $this->Form->label('Role') ?>
                            <?= $this->Form->select('role', [$user->role => $user->role], ['class' => 'form-control']); ?>
                        </div>
                    </div>
                    <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    </div> -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <?= $this->Form->label('Profile Image') ?>
                            <?= $this->Form->File('profile_img', ['class' => 'form-control']) ?>

                        </div>
                    </div>

                </div>
                <div class="row gutters mt-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <!-- <button type="reset" id="submit" name="submit" >Cancel</button> -->
                            <?= $this->Form->button('Cancel', ['type' => 'reset', 'class' => 'btn btn-danger']) ?>
                            <?= $this->Form->button('Update', ['name' => 'update', 'type' => 'submit', 'class' => 'btn btn-primary']) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->Form->end() ?>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <?=$this->Form->create(null,['url' => ['controller'=>'users','action' => 'changePassword',$user->id]])?>

        <div class="card h-100">
            <div class="card-body">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Reset Password</h6>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('Old Password') ?>
                        <?= $this->Form->password('o_pwd', ['class' => 'form-control', 'placeholder' => "Current Password",'required'=>true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('New Password') ?>
                        <?= $this->Form->password('n_pwd', ['class' => 'form-control', 'placeholder' => "New Password",'required'=>true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('Confirm Password') ?>
                        <?= $this->Form->password('c_pwd', ['class' => 'form-control', 'placeholder' => "Confirm Password",'required'=>true]) ?>
                    </div>
                    <div class="row gutters mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <?= $this->Form->button('Update Password', ['name' => 'up_pass', 'type' => 'submit', 'class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?=$this->Form->end()?>

    </div>
</div>