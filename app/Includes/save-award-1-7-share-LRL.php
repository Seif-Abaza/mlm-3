<?php
$saved_share = $this->saveEachShare($upline_uuid.'LRL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
//sponsoring bonus
$this->awardSponsoringBonus($r_sponsor, $saved_share->uuid);
//matching bonus
$this->awardMatchingBonuses($saved_share);