<?php
    $userMap = new UserMap();
    $user = $userMap->findById($id);
?>
<div class="form-group">
    <label>Username</label>
    <input type="password" class="form-control" name="username" required="required" value="<?=$user->username;?>">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" required="required">
</div>
<div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="firstname" required="required" value="<?=$user->firstname;?>">
</div>
<div class="form-group">
    <label>Patronymic</label>
    <input type="text" class="form-control" name="patronymic" required="required" value="<?=$user->patronymic;?>">
</div>
<div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lastname" value="<?=$user->lastname;?>">
</div>
<div class="form-group">
    <label>Address</label>
    <input type="date" class="form-control" name="address" value="<?=$user->address;?>">
</div>
<div class="form-group">
    <label>Phone</label>
    <input type="text" class="form-control" name="phone" required="required" value="<?=$user->phone;?>">
</div>
<input type="hidden" name="user_id" value="<?=$id;?>"/>