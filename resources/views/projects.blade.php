<html>
 <head>
 <title>Projetos</title>
 </head>

 <body>

 <h1>Projetos</h1>



 <table border="1">
 @foreach($projetos as $projeto)
  <tr>
   <td>{{ $projeto->id }}</td>
   <td>{{ $projeto->implementation_period_start }}</td>
   <td>{{ $projeto->number }}</td>
   <td>{{ $projeto->meeting_date }}</td>
   <td>{{ $projeto->title }}</td>
   <td>{{ $projeto->summary }}</td>
   <td>{{ $projeto->project_value }}</td>
   <td>{{ $projeto->results }}</td>
   <td>{{ $projeto->project_year->year }}</td>
   <td>{{ $projeto->project_type->name }}</td>
   <td>{{ $projeto->project_situation->name }}</td>
   <td>
       @foreach($projeto->project_partner as $pp)
        {{ $pp->name }} - {{ $pp->url }}
       @endforeach
       {{--{{ $projeto->project_partner->name }}</td>--}}
  </tr>

 @endforeach
 </table>

 <table border="1">
 @foreach($partners as $partner)
     <tr>
         <td>{{ $partner->id }}</td>
         <td>{{ $partner->name }}</td>
         <td>{{ $partner->url }}</td>
         <td>{{ $partner->partner_group->name }}</td>
         <td>{{ $partner->partner_image->image or "-"}}</td>

     </tr>
 @endforeach
 </table>

 </body>
 <html>