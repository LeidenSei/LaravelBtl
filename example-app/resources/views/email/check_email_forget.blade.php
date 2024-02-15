<div style="width: 600px;margin: 0 auto">
    <div style="text-align: center">
       <h2>Hello {{$user->name}}</h2>
        <p>"This is the mail to help you regain your forgotten password."</p>
        <p>The verification code expires in 24 hours</p>
        <p>
            <a style="display:inline-block;background:green;color:#fff;padding:7px 25px;font-weight:bold" href="{{route('user.getPass',['user'=>$user->id,'token'=>$user->remember_token])}}">Retrieve password </a>
        </p>
    </div>
        
</div>