 
        <table>
                                    <thead>
                                <tr>

                                    
            <td>SR </td>   
            <td>name</td>
            <td>mobile</td> 
            <td>address</td>       
                             </tr>
                                    </thead>
                                    <tbody> 

        <?php $sr=1;?>
        @foreach($customers as $customer)                                    
        <tr>
            <td>{{$sr++}}  </td>   
            <td>{{$customer->name}}</td>
            <td>{{$customer->mobile}}</td> 
            <td>{{$customer->address}}</td> 
        </tr> 

        @endforeach
        </tbody>
                                </table>
      