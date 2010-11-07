<?php 
/**
 * Archive
 *
 * Displays and starts the website archives 	
 *
 * @package GetSimple
 * @subpackage Backups
 */

// Setup inclusions
$load['plugin'] = true;

// Include common.php
include('inc/common.php');

// Variable Settings
login_cookie_check();
$table = '';

// if a backup needs to be created
if(isset($_GET['do'])) {
	$nonce = $_GET['nonce'];
	if(!check_nonce($nonce, "create"))
		die("CSRF detected!");	
	exec_action('archive-backup');
	redirect('zip.php?s='.$SESSIONHASH);	
}

// if a backup has just been created
if(isset($_GET['done'])) {
	$success = i18n_r('SUCC_WEB_ARCHIVE');
}

if(isset($_GET['nozip'])) {
	$error = i18n_r('NO_ZIPARCHIVE');
}


?> 

<?php get_template('header', cl($SITENAME).' &raquo; '.i18n_r('BAK_MANAGEMENT').' &raquo; '.i18n_r('WEBSITE_ARCHIVES')); ?>
	
	<h1><a href="<?php echo $SITEURL; ?>" target="_blank" ><?php echo cl($SITENAME); ?></a> <span>&raquo;</span> <?php i18n('BAK_MANAGEMENT'); ?> <span>&raquo;</span> <?php i18n('WEBSITE_ARCHIVES'); ?></h1>
	
	<?php include('template/include-nav.php'); ?>
	<?php include('template/error_checking.php'); ?>

	<div class="bodycontent">
	
	<div id="maincontent">
		<div class="main" >
		<h3 class="floated"><?php i18n('WEBSITE_ARCHIVES');?></h3>
		<div class="edit-nav" >
                    <a id="waittrigger" href="archive.php?do&nonce=<?php echo get_nonce("create"); ?>" accesskey="<?php echo find_accesskey(i18n_r('ASK_CREATE_ARC'));?>" title="<?php i18n('CREATE_NEW_ARC');?>" ><?php i18n('ASK_CREATE_ARC');?></a>
		<div class="clear"></div></div>
		<p style="display:none" id="waiting" ><?php i18n('CREATE_ARC_WAIT');?></p>
		<table class="highlight paginate">	
		<?php
			$count="0";
			$path = tsl(GSBACKUPSPATH .'zip/');
			
			$filenames = getFiles($path);

			natsort($filenames);
			rsort($filenames);
			
			foreach ($filenames as $file) {
				if($file[0] != "." ) {
					$timestamp = explode('_', $file);
					$name = shtDate($timestamp[0]);
					clearstatcache();
					$ss = stat($path . $file);
					$size = fSize($ss['size']);
					echo '<tr>
							<td><a title="'.i18n_r('DOWNLOAD').' '. $name .'" target="_blank" href="download.php?file='. $path . $file .'&nonce='.get_nonce("archive", "download.php").'">'.$name .'</a></td>
							<td style="width:70px;text-align:right;" ><span>'.$size.'</span></td>
							<td class="delete" ><a class="delconfirm" title="'.i18n_r('DELETE_ARCHIVE').' '. $name .'?" href="deletefile.php?zip='. $file .'&nonce='.get_nonce("delete", "deletefile.php").'">X</a></td>
						  </tr>';
					$count++;
				}
			}

		?>
		</table>
		<p><em><b><?php echo $count; ?></b> <?php i18n('TOTAL_ARCHIVES');?></em></p>
		</div>
	</div>
	
	<div id="sidebar" >
		<?php include('template/sidebar-backups.php'); ?>
	</div>

	
	<div class="clear"></div>
	</div>
<?php get_template('footer'); ?>