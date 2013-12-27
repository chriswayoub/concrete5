<? if (is_object($user)) { ?>

<div class="container" data-container="editable-fields">
	<fieldset>
		<legend><?=t('Basic Details')?></legend>
		<div class="row">
			<div class="col-md-2"><p><?=t('Username')?></p></div>
			<div class="col-md-4"><p><strong <? if ($canEditUserName) { ?>data-editable-field-type="xeditable" data-url="<?=$view->action('update_username', $user->getUserID())?>" data-type="text" data-name="uName" <? } ?>><?=$user->getUserName()?></strong></p></div>
			<div class="col-md-2"><p><?=t('Email Address')?></p></div>
			<div class="col-md-4"><p><strong <? if ($canEditEmail) { ?>data-editable-field-type="xeditable" data-url="<?=$view->action('update_email', $user->getUserID())?>"data-type="email" data-name="uEmail"<? } ?>><?=$user->getUserEmail()?></strong></p></div>
		</div>
		<div class="row">
			<div class="col-md-2"><p><?=t('Password')?></p></div>
			<div class="col-md-4"><p><? if ($canEditPassword) { ?><a href="#" class="btn btn-xs btn-default" data-button="change-password"><?=t('Change')?></a><? } else { ?>*********<? } ?></p></div>
			<div class="col-md-2"><p><?=t('Profile Picture')?></p></div>
			<div class="col-md-4"><p>
				<div <? if ($canEditAvatar) { ?>data-editable-field-type="image" data-url="<?=$this->action('update_avatar', $user->getUserID())?>"<? } ?>>
					<a href="#" class="ccm-icon-wrapper" data-editable-field-command="clear"><i class="glyphicon glyphicon-trash"></i></a>
                    <span class="editable-image-wrapper">
	                    <input type="file" id="file-avatar" name="avatar" />
	                    <div class="editable-image-display"><?=Loader::helper('concrete/avatar')->outputUserAvatar($user)?></div>
					</span>
				</div>
			</p>
		</div>
	</fieldset>
	<br/>

	<fieldset>
		<legend><?=t('Groups')?></legend>
		<div class="row">
			<div class="col-md-2"><p><?=t('Username')?></p></div>
			<div class="col-md-10"><p><strong data-editable="true" data-type="text" data-name="uName"><?=$user->getUserName()?></strong></p></div>
		</div>
	</fieldset>

	<fieldset>
		<legend><?=t('Other Attributes')?></legend>
		<div class="row">
			<div class="col-md-2"><p><?=t('Username')?></p></div>
			<div class="col-md-10"><p><strong data-editable="true" data-type="text" data-name="uName"><?=$user->getUserName()?></strong></p></div>
		</div>
	</fieldset>

</div>

<? if ($canEditPassword) { ?>
	
	<div style="display: none">
		<div data-dialog="change-password">
			<form data-dialog-form="change-password" action="<?=$view->action('change_password', $user->getUserID())?>">
				<?=Loader::helper('validation/token')->output('change_password')?>

				<div class="dialog-buttons">
				<button class="btn pull-left" data-dialog-action="cancel"><?=t('Cancel')?></button>
				<button type="button" data-dialog-action="submit" class="btn btn-primary pull-right"><?=t('Update')?></button>
				</div>
				

			</form>
		</div>
	</div>
<? } ?>

<script type="text/javascript">
$(function() {
	$('div[data-container=editable-fields]').concreteEditableFieldContainer({
		url: '<?=$this->action('save', $user->getUserID())?>',
		data: {
			token: '<?=Loader::helper('validation/token')->generate('save')?>'
		}
	});

	$('div[data-container=editable-fields]').on('click', 'a[data-button=change-password]', function() {
		$.fn.dialog.open({
			element: 'div[data-dialog=change-password]',
			title: '<?=t('Change Password')?>',
			width: '280',
			height: '140',
			modal: true
		});
		return false;
	});
});
</script>
<? } else {
	
	$tp = Loader::helper('concrete/user');
	if ($tp->canAccessUserSearchInterface()) { ?>
		
		<div class="ccm-dashboard-content-full" data-search="users">
		<? Loader::element('users/search', array('controller' => $searchController))?>
		</div>


	<? } else { ?>
	<div class="ccm-pane-body">
		<p><?=t('You do not have access to user search. This setting may be changed in the access section of the dashboard settings page.')?></p>
	</div>	

	<? } ?>

<? } ?>