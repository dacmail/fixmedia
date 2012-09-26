<div id="container">
	<div id="content">

		<h3>Users</h3>
		<p>Below is a list of the users.</p>

		<div id="infoMessage"><?php echo $message;?></div>

		<table cellpadding=0 cellspacing=10>
			<tr>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Groups</th>
				<th>Status</th>
			</tr>
			<?php foreach ($users as $user):?>
				<tr>
					<td><?php echo $user->username;?></td>
					<td><?php echo $user->name;?></td>
					<td><?php echo $user->email;?></td>
					<td>
						<?php foreach ($user->groups as $group):?>
							<?php echo $group->name;?><br />
		                <?php endforeach?>
					</td>
					<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Active') : anchor("auth/activate/". $user->id, 'Inactive');?></td>
				</tr>
			<?php endforeach;?>
		</table>

		<p><a href="<?php echo site_url('auth/create_user');?>">Create a new user</a></p>

	</div>
</div>
