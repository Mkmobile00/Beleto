<body>
    <form action="https://payment.imepay.com.np:7979/WebCheckout/Checkout" method="post" id="imepay-form">
        <input type="hidden" name="TokenId" value="{{$tokenId}}">
        <input type="hidden" name="MerchantCode" value="{{$merchantCode}}">
        <input type="hidden" name="RefId" value="{{$refId}}">
        <input type="hidden" name="TranAmount" value="{{$amount}}">
        <input type="hidden" name="Method" value="{{$method}}">
        <input type="hidden" name="RespUrl" value="{{$successUrl}}">
        <input type="hidden" name="CancelUrl" value="{{$failureUrl}}">
        </form>
        
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#imepay-form').submit();
        });
    </script>
</body>