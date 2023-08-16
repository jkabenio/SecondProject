@extends('layouts.app')
@section('content')

<style>

</style>
<div class="index_page_css" style="position:relative;">
    <div class="container container_landing_page">
        <img class="ollcf_logo_css"src="img/Ollfc_Logo.png" alt="Italian Trulli"/>
        <h1 class="index_title"><b> OUR LADY OF LOURDES COLLEGE FOUNDATION</b></h1>
        <div class="login_btn">
            <a href="{{ route('student.student_login') }}"><button class="login_style" >Student </button></a>
            <br>
            <a href="{{ route('admin.admin_login') }}"><button class="login_style" >Administrator</button></a>
            <br>
            <a href="{{ route('signee.signee_login') }}"><button class="login_style" >Signee</button></a>
        </div>
    </div>
</div>
@endsection

 




