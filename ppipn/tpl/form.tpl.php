<form action="<?php print $this->pp_post_url?>" method="post">
<input type="hidden" name="business" value="<?php print $this->_business?>">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="return" value="<?php print $this->_pp_entrypoint_return?>">
<input type="hidden" name="cancel_return" value="<?php print $this->_pp_entrypoint_cancel?>">
<input type="hidden" name="notify_url" value="<?php print $this->_pp_entrypoint_ipn?>">
<input type="hidden" name="currency_code" value="USD">
<input type="text" name="item_name" value="<?php print $this->title?>">
<input type="text" name="amount" value="<?php print $this->price?>">
<input type="hidden" name="item_number" value="<?php print $this->ordercode?>">
<div class="ppipnsubmitbtn"><input type="submit" value="Check out"></div>
</form>