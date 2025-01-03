<div id="unBilledShipmentLoop">
    {{-- @dd($days) --}}
    <div class="row">
        <div class="col-md-3">
            <select name="days" id="days"  class="form-control remainingdays">
                <option value="">Filter by Remaining Days</option>
                @foreach (filterDays() as $key=>$dataValue)
                    <option value="{{$dataValue}}" {{@$days==$dataValue ? 'selected':''}}>{{$key}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <table class="table table-striped table-valign-middle table-sm captionShow">
        <caption>{{@$title}}</caption>
        <thead>
            <tr>
                <th>SN</th>
                <th>Customer</th>
                {{-- <th>Title</th> --}}
                <th>Subscription</th>
                <th>Total Days</th>
                <th>Left Days</th>
                {{-- <th>percentage</th> --}}
                <th>From/To</th>
                <th>Expired On</th>
            </tr>
        </thead>
        <div>
            <tbody>
                @foreach ($allSubscription as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <a href="{{route('customer.show',$data['customer_id'])}}" target="_blank">{{$data['customer']}}</a>
                        </td>
                        
                        {{-- <td>{{$data['title']}}</td> --}}
                        <td>
                            <a href="{{route('subscription.index')}}" target="_blank">{{$data['subscription_id']}}</a>
                        </td>

                       
                        <td>
                            <span class="badge badge-success"> {{$data['total_days']}}</span>
                           
                        </td>
                        <td>
                            <span class="badge badge-{{(int)$data['left_days'] > 0 ?'success':'danger'}}">{{$data['left_days']}}</span>
                            
                        </td>
                        {{-- <td>{{$data['percentage']}}</td> --}}
                        <td>{{$data['from']}} / {{$data['to']}}</td>
                        <td>{{$data['to']}}</td>
                        
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="text-right mt-2">
                <tr>
                    <td colspan="9">
                        <ul class="pagination">
                            @foreach ($allSubscription->links('pagination::bootstrap-4')->elements as $element)
                                @if (is_string($element))
                                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        <li
                                            class="page-item {{ $page == $allSubscription->currentPage() ? 'active' : '' }}">
                                            <a class="page-link unbilled-link"
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


    </table>
</div>
