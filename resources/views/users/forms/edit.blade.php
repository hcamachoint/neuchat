{!!Form::label('State ID')!!}
{!!Form::text('idn', $user->idn, ['class'=>'form-control', 'placeholder'=>'Example: A123456789012', 'required'=>'true', 'maxlength' => 13])!!}
<br>
{!!Form::label('First Name')!!}
{!!Form::text('name', $user->name, ['class'=>'form-control', 'placeholder'=>'Your first Name', 'required'=>'true', 'maxlength' => 20])!!}
<br>
{!!Form::label('Last Name')!!}
{!!Form::text('name2', $user->name2, ['class'=>'form-control', 'placeholder'=>'Your last Name', 'maxlength' => 20])!!}
<br>
{!!Form::label('Sex')!!}
{!!Form::select('sex', ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'], $user->sex, ['class'=>'form-control', 'placeholder' => 'Select your sex']);!!}
<br>
{!!Form::label('Email')!!}
{!!Form::text('email', $user->email, ['class'=>'form-control', 'placeholder'=>'Your email address', 'required'=>'true', 'maxlength' => 30, 'readonly' => 'true'])!!}
<br>
{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-success', 'type'=>'submit'])!!}
