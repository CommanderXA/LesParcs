<?php
    $user = (new UserMap())->findProfileById($id);
    if ($user) {
?>
<tr>
    <th>Username</th>
    <td><?=$user->username;?></td>
</tr>
<tr>
    <th>Full Name</th>
    <td><?=$user->full_name;?></td>
</tr>
<tr>
    <th>Address</th>
    <td><?=$user->address;?></td>
</tr>
<tr>
    <th>Phone</th>
    <td><?=$user->phone;?></td>
</tr>
<tr>
    <th>Role</th>
    <td><?=$user->role;?></td>
</tr>
<?php } ?>