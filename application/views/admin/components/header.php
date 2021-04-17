<nav class="navbar navbar-expand-xl navbar-dark bg-secondary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand float-left" href="<?= base_url() ?>admin_company_point">総括表（ジャコス集計）メイン画面</a>

  <div class="collapse navbar-collapse float-right" id="navbarTogglerDemo03">
    
    <ul class="navbar-nav ml-auto">
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="--><?//= base_url() ?><!--allcompany_list" tabindex="-1" aria-disabled="true">ジャコス管理表(大分類)</a>-->
<!--        </li>-->
    	<li class="nav-item">
    	  <a class="nav-link" href="<?= base_url() ?>admin_company_point" tabindex="-1" aria-disabled="true">加盟企業</a>
    	</li>
    	<li class="nav-item">
    	  <a class="nav-link" href="<?= base_url() ?>setting_point_sharing" tabindex="-1" aria-disabled="true">設定点</a>
    	</li> 
        <!-- <li class="nav-item">
          <a class="nav-link" href="gift_codes" tabindex="-1" aria-disabled="true">アマゾンギフトコード</a>
        </li> -->
    	<li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>admin/balance_sheet" tabindex="-1" aria-disabled="true">サイト入金</a>
      </li>
      <!-- <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>admin/gift_code" tabindex="-1" aria-disabled="true">GiftCode</a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">GiftCode</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= base_url() ?>admin/gift_code">GiftCode</a>
          <a class="dropdown-item" href="<?= base_url() ?>admin/gift_code/report">Report</a>
          
          <!-- <div role="separator" class="dropdown-divider"></div> -->
        </div>
      </li>
    	<li class="nav-item">
    	  <a class="nav-link" href="<?= base_url() ?>upload_referal_fee" tabindex="-1" aria-disabled="true">紹介料をアップロード</a>
    	</li>
    	<li class="nav-item">
    	  <a class="nav-link" href="<?= base_url() ?>kamitein_list" tabindex="-1" aria-disabled="true">加盟店REFARAL</a>
    	</li>
      <li class="nav-item dropdown border-0">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">設定</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#size_unit">単位</a>
          <a class="dropdown-item" href="<?= base_url() ?>admin/settings">製品検索設定</a>
          
          <!-- <div role="separator" class="dropdown-divider"></div> -->
        </div>
      </li>
    	
    </ul>
  </div>
</nav>
<!-- <a href="<?= base_url() ?>" class="btn btn-warning btn-lg float-right">戻る</a>
				
<button type="button" class="btn btn-primary btn-lg float-right" data-toggle="modal" data-target="#size_unit" style="margin-right: 10px;">単位</button>
<a href="setting_point_sharing" class="btn btn-secondary btn-lg float-right" style="margin-right: 10px;"><i class="fa fa-cog"></i> 設定点</a>
<a href="kamitein_list" class="btn btn-info btn-lg float-right" style="margin-right: 10px;">加盟店REFARAL</a>
<a href="admin_company_point" class="btn btn-info btn-lg float-right" style="margin-right: 10px;">加盟機関による</a>
<a href="upload_referal_fee" class="btn btn-info btn-lg float-right" style="margin-right: 10px; ">紹介料をアップロード</a> -->