<h2>Dear {{ $name }} </h2>
<p>You have been Registered As Joint Holder at an account</p>
<p>In order to further proceed you must fill KYC Forms and Accept Our Terms and Conditions</p>
<p>Use this <a
        href="{{ route('joint.kyc.index', [$account_id, $joint_id, $link]) }}">{{ route('joint.kyc.index', [$account_id, $joint_id, $link]) }}</a>
    to
    fill your KYC form</p>
