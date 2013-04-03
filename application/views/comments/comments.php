<div class="comments" id="comments-<?= $subreport->id; ?>">
	<div class="clearfix">
		<? if (count($subreport->parent_comments)) : ?>
		<a href="#" data-alttext="<? _e('Ocultar comentarios'); ?>" class="toggle show"><? _e('Mostrar comentarios'); ?></a>
		<? else : ?>
		<a href="#" class="toggle show"><? _e('Comentar'); ?></a>
		<? endif; ?>
		<span class="comments-count"><?= count($subreport->comments); ?></span>
	</div>
	<? if (count($subreport->parent_comments)) : ?>
		<ul class="comments-list">
		<? foreach ($subreport->parent_comments as $comment) : ?>
			<li class="comment" id="<?= $comment->id; ?>">
				<div class="avatar"><?=get_avatar( $comment->user, 30, $comment->user->name); ?></div>
				<h4 class="comment-author">
					<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $comment->user->username))); ?>">
						<?= $comment->user->name; ?>
					</a>
					<span class="date"><?= relative_time($comment->created_at->format('db')); ?></span>
					<a href="#" class="reply"><? _e('Responder'); ?></a>
				</h4>
				<div class="comment-content"><?= $comment->content; ?></div>
			</li>
			<? if (count($comment->children)) : ?>
					<ul class="comments-list children">
					<? foreach ($comment->children as $child) : ?>
						<li class="comment" id="<?= $child->id; ?>">
							<div class="avatar"><?=get_avatar( $child->user, 30, $child->user->name); ?></div>
							<h4 class="comment-author">
								<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $child->user->username))); ?>">
									<?= $child->user->name; ?>
								</a>
								<span class="date"><?= relative_time($child->created_at->format('db')); ?></span>
							</h4>
							<div class="comment-content"><?= $child->content; ?></div>
						</li>
					<? endforeach; ?>
					</ul>
				<? endif; ?>
		<? endforeach; ?>
		</ul>
	<? endif; ?>
</div>