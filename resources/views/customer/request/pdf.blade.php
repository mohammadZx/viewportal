<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body{
        font-family: 'fa', sans-serif;

    }
    @page {
	header: page-header;
	footer: page-footer;
}
.header-info{
    padding-top: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid #ccc;
}
.header-info td{
    direction: rtl;
    width: 23%;
}
.header-info td.n{
    width: 10%;
}
.content{
    padding-top: 90px;
}
.content td, .content .th{
    text-align: left;
}
    </style>
</head>
<body>

<htmlpageheader name="page-header">
        <table class="header-info">
            <tr>
                <td>
                    <strong>نام صاحب حیوان: </strong>
                    <span>{{$request->transaction->user->name}}</span>
                </td>
                <td>
                    <strong>نام حیوان: </strong>
                    <span>{{$request->getMeta('name', true)}}</span>
                </td>
                <td class="n">
                    <strong>سن: </strong>
                    <span>{{$request->getMeta('age', true)}}</span>
                </td>
                <td>
                    <strong>تاریخ: </strong>
                    <span>{{\Verta::now()->format('Y-m-d')}}</span>
                </td>
            </tr>
        </table>
 
</htmlpageheader>
   
           <div class="content">
            <p><Strong>Status: </Strong> {{ $comment->getMeta('status', true) ? 'تایید شده توسط کارشناس دوم' : 'بدون وضعیت' }}</p>

            <p><Strong>Graph</Strong></p>
            <div>{{ $comment->getMeta('graph', true) }}</div>
        
            <p><Strong>Tech</Strong></p>
            <div>{{ $comment->tech }}</div>
        
            <p><Strong>Interpretation</Strong></p>
            <div>{{ $comment->interpretation }}<div>
      
            <p><Strong>Diagnosis</Strong></p>
            <div>{{ $comment->diagnosis }}<div>
      
            <p><Strong>Comment</Strong></p>
            <div>{!! $comment->content !!}<div>
        
           </div>

    <htmlpagefooter name="page-footer">

</htmlpagefooter>
</body>
</html>