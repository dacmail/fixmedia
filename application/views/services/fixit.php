<?php echo form_open($this->router->reverseRoute('reports-create'), array('target' => '_blank')) ?>
	<input type="hidden" value="<?= $url ?>" name="url" /><br />
	<input class="submit button" type="submit" name="submit" value="Fixit" /> 
</form>