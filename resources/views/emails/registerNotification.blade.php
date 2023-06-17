
<table>

        <tr>
            <th>
                Name
            </th>
            <td>
                {{$title}}  {{$name}}
            </td>
        </tr>
        <tr>
            <th>
                contact
            </th>
            <td>
                {{$phone}}
            </td>
        </tr>
    
        <tr>
            <th>
                Link
            </th>
            <td>
               <a href="{{route('admin.clients.management')}}">{{route('admin.clients.management')}}</a>
            </td>
        </tr>
    
</table>

