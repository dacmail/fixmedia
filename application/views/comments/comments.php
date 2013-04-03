<div class="comments" id="comments-<?= $subreport->id; ?>">
	<div class="clearfix">
		<? if (count($subreport->parent_comments)) : ?>
		<a href="#" data-alttext="<? _e('Ocultar comentarios'); ?>" class="toggle show"><? _e('Mostrar comentarios'); ?></a>
		<? else : ?>
		<a href="#" class="toggle show"><? _e('Comentar'); ?></a>
		<? endif; ?>
		<span class="comments-count"><?= count($subreport->comments); ?></span>
	</div>
		<ul class="comments-list main">
		<? foreach ($subreport->parent_comments as $comment) : ?>
			<li class="comment" id="comment-<?= $comment->id; ?>">
				<div class="avatar"><?=get_avatar( $comment->user, 30, $comment->user->name); ?></div>
				<h4 class="comment-author">
					<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $comment->user->username))); ?>">
						<?= $comment->user->name; ?>
					</a>
					<span class="date"><?= relative_time($comment->created_at->format('db')); ?></span>
					<a href="#" data-replyto="<?= $comment->id; ?>" data-form="comment-form-<?= $subreport->id; ?>" class="reply"><? _e('Responder'); ?></a>
				</h4>
				<div class="comment-content"><?= $comment->content; ?></div>
			</li>
			<? if (count($comment->children)) : ?>
					<ul class="comments-list children">
					<? foreach ($comment->children as $child) : ?>
						<li class="comment" id="comment-<?= $child->id; ?>">
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
		<?= form_open('comments/create', array('class' => 'clearfix comment-form', 'id' => 'comment-form-' . $subreport->id), array('reports_data_id' => $subreport->id, 'parent' => 0)); ?>
			<div class="avatar"><?=get_avatar( $the_user, 30, $the_user->name); ?></div>
			<textarea name="content" placeholder="<? _e('Escribe un comentario'); ?>"></textarea>
			<input class="submit-comment button" type="submit" name="submit" value="<? _e('Comentar'); ?>" />
		</form>
		</ul>
</div>