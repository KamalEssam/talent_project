@component('mail::message')
# Introduction

We have recieved a request for reset password.

@component('mail::button', ['url' => url('http://talents.dev/apassword/reset/'.$data['token'])])
Click here to reset password Now
@endcomponent

Thanks,<br>
Talent-Kids
@endcomponent