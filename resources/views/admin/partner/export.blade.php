 
        <table>
                                    <thead>
                                <tr>

                                    
            <td>SR </td>   
            <td>name</td>
            <td>mobile</td>
            <td>email</td>
            <td>password</td>
            <td>address</td>
            <td>company_name</td>
            <td>bank_name</td>
            <td>bank_address</td>
            <td>ifsc_code</td>
            <td>account_no</td>
            <td>state</td>
            <td>gst</td>                           
                             </tr>
                                    </thead>
                                    <tbody>

                                    

        <?php $sr=1;?>
        @foreach($customers as $customer)                                    
        <tr>
            <td>{{$sr++}}  </td>   
            <td>{{$customer->name}}</td>
            <td>{{$customer->mobile}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->password}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->company_name}}</td>
            <td>{{$customer->bank_name}}</td>
            <td>{{$customer->bank_address}}</td>
            <td>{{$customer->ifsc_code}}</td>
            <td>{{$customer->account_no}}</td>
            <td>{{$customer->state}}</td>
            <td>{{$customer->gst}}</td>
        </tr> 

        @endforeach
        </tbody>
                                </table>
      