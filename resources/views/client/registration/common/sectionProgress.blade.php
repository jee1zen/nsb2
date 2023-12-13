 <!-- progressbar -->
 <ul id="progressbar">
     <li class="{{ $title == 'account' ? 'active' : '' }}" id="account"><strong> Account Type</strong></li>
     {{-- <li id="account"><strong>Identification</strong></li> --}}
     <li class="{{ $title == 'basic' ? 'active' : '' }}" id="basic"><strong>Basic Info</strong></li>
     @if ($account_type == 2)
         <li class="{{ $title == 'joint' ? 'active' : '' }}" id="joint"><strong>Joint Info</strong></li>
     @endif
     <li class="{{ $title == 'employment' ? 'active' : '' }}" id="employment"><strong>Employment Info</strong></li>
     <li class="{{ $title == 'benefactor' ? 'active' : '' }}" id="benefactor"><strong>Benefactor Info</strong></li>
     <li class="{{ $title == 'bank' ? 'active' : '' }}" id="bank"><strong>Bank Particulars</strong></li>
     <li class="{{ $title == 'other' ? 'active' : '' }}" id="other"><strong>Other Info</strong></li>
     <li class="{{ $title == 'KYC' ? 'active' : '' }}" id="KYC"><strong>KYC</strong></li>
     <li class="{{ $title == 'confirm' ? 'active' : '' }}" id="confirm"><strong>Finish</strong></li>
 </ul>
 <div class="progress">
     <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" width="14"
         aria-valuemin="0" aria-valuemax="100"> </div>
 </div> <br>
