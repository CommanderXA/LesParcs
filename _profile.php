<?php
    $user = (new UserMap())->findProfileById($id);
    if ($user) {
?>
<tr>
    <th>Username</th>
    <td><?=$user->username;?></td>
</tr>
<tr>
    <th>First Name</th>
    <td><?=$user->firstname;?></td>
</tr>
<?php if ($user->patronymic) : ?>
    <tr>
        <th>Patronymic</th>
        <td><?=$user->patronymic;?></td>
    </tr>
<?php endif; ?>
<tr>
    <th>Last Name</th>
    <td><?=$user->lastname;?></td>
</tr>
<?php if ($user->address) : ?>
    <tr>
        <th>Address</th>
        <td><?=$user->address;?></td>
    </tr>
<?php endif; ?>
<?php if ($user->phone) : ?>
    <tr>
        <th>Phone</th>
        <td><?=$user->phone;?></td>
    </tr>
<?php endif; ?>
<tr>
    <th>Role</th>
    <td><?=$user->role;?></td>
</tr>
<?php } ?>