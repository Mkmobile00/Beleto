<div class="card-body table-responsive p-0" id="searchCustomer">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>SN</th>
                <th>Email/Phone</th>
                <th>Name</th>
                <th>Status</th>
                <th>Joined Date</th>
                <th>Add Subscription</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody >
            @foreach($customers as $key=>$data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td >{{ @$data->email }}{{@$data->phone ? ('/ '.$data->phone ): ''}}
                        <span class="badge badge-{{ $data->email_verified_at ? 'success':'danger' }}" title="{{ $data->email_verified_at ? 'Verified User':'UnVerified User' }}">
                            <i class="fas fa-{{ $data->email_verified_at ? 'check':'times' }}"></i>
                        </span>
                    </td>
                    <td>{{ @$data->customerDetail->first_name.' '. @$data->customerDetail->last_name }}
                    </td>
                    <td>
                        <span class="badge badge-{{@$data->status->value=='1' ? 'success':'danger'}}">{{@$data->status->name}}</span> 
                        </td>
                        <td>{{ $data->created_at->formatLocalized('%d %B, %Y') }} {{$data->created_at->format('H:i:s A')}}</td>
                    <td>
                        <a href="{{route('setcustomercustome.susbcription',$data->id)}}">
                            <span class="badge badge-primary">Add 
                                <i class="fas fa-plus"></i>    
                            </span>  
                           
                        </a>
                        
                        @foreach ($data->subscription as $subdata)
                        <a href="{{route('subscription.edit',$subdata->subscription->id)}}" target="_blank">
                            <span class="badge badge-info" title="{{@$subdata->subscription->title}}">
                                {{ substr($subdata->subscription->title, 0, 1) }}
                            </span>
                        </a>
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{route('customer.show',$data->id)}}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-sm btn-primary" href="{{route('customer.edit',$data->id)}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="javascript:;"
                            class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor"
                            data-id="{{ $data->id }}">
                            <i class="fas fa-trash"></i>
                        </a>
                        {{ Form::open(['url' => route('customer.destroy', $data->id), 'class' => 'delete-form']) }}
                        @method('delete')
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <tfoot class="text-right mt-2">
        <tr>
            <td colspan="9">
                <ul class="pagination">
                    @foreach ($customers->links('pagination::bootstrap-4')->elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <li
                                    class="page-item {{ $page == $customers->currentPage() ? 'active' : '' }}">
                                    <a class="page-link movie-type searchDataPaginate"
                                        href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </td>
        </tr>
    </tfoot>
</div>