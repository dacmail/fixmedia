<div id="container" class="clearfix sending adding columns">
	<div id="content">
		<?php $this->load->view('includes/report-info'); ?>
		<div class="validation_errors">
			<?php echo validation_errors(); ?>
		</div>
		<? $hidden_fields = array('report_id' => $report->id, 'report_url' => $report->url, 'report_title' => $report->title, 'site' => $report->site); ?>
		<?php echo form_open($this->router->reverseRoute('reports-preview'), array('id' => 'form_report', 'class' => 'clearfix'), $hidden_fields) ?>
			<div class="report_data">
				<p><label class="label">Elige el tipo de reporte</label>
				<div class="wrap_types clearfix">
				<? foreach ($reports_types_tree as $report_type) : ?>
					<span class="wrap_type">
						<input data-count="1" data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type[0]" class="main_type_radio" id="type_<?=$report_type->id;?>" value="<?=$report_type->id;?>" />
						<label for="type_<?=$report_type->id;?>"><?=$report_type->type;?></label>
					</span>
				<? endforeach; ?>
				</div>
				</p>
				<div class="fields_wrap" id="fields_1"></div>
			</div>

			<a href="#" id="add_more" data-service="<?php echo site_url('services/get_more_data'); ?>" class="add">Añadir otra corrección/ampliación</a>
			<input id="submit" type="submit" class="button submit" name="submit" value="Veamos cómo queda" />
		</form>
		<a href="<?= site_url(); ?>" id="cancel" class="cancel">Cancelar</a>
	</div>
	<aside id="sidebar" class="report">
		<div class="counter">
			<span class="count count-vote-<?= $report->id ?>"><?= $report->votes_count ?></span>
			<? if ($report->votes_count==1 && ($logged_in && $report->is_voted($the_user->id))) : ?>
			persona (tú) quiere que alguien la arregle
			<? elseif ($report->votes_count==1) :?>
			persona quiere que alguien la arregle
			<? else : ?>
			personas  quieren que alguien la arregle
			<? endif; ?>
		</div>
	</aside>
</div>