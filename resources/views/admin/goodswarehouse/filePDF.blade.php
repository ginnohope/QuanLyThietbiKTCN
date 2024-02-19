<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu nhập hàng</title>
    <style>
      body {
          font-family: 'DejaVu Sans', sans-serif;
          font-size: 14px;
          line-height: 1.6;
          margin: 0;
          padding: 0;
          text-align: center; 
      }
  
      .container {
          margin: 0 auto; 
          width: 100%;
      }
  
      table {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        border-collapse: collapse;
    }
  
      .table_frame th, .table_frame td {
          border: 1px solid #ddd;
          padding: 8px;
          text-align: left;
      }

  
      h2 {
          color: #333;
          line-height: 10px;
      }
  
      .center {
          text-align: center;
      }
  
      .summary-table {
          margin-bottom: 20px;
      }
  
      .date {
          float: right;
      }
  
      .signatures {
          margin-top: 20px;
      }
  
      .writer-name {
          font-weight: bold;
      }
  
      @page {
          size: A4;
          margin: 20px;
      }

      .m-20 {
        margin: 10px 0;
      }

      .text {
        text-align: left;
      }

      .img {
        width: 100px;
      }

      .mt-50 {
        margin-top: 50px;
      }

  </style>
  
</head>
<body class="container">

    <table class="table_frame">
        <thead>
            <tr>
                <th>
                    <img class="img" src="{{ 'storage/images/logos/'. $goodswarehouse->supplier->s_logo }}" alt="">
                </th>
                <th width = "300px">
                    <div class="text">
                        <p><strong>Tên công ty: </strong>{{$goodswarehouse->supplier->s_name}}</p>
                        <p><strong>Điện thoại: </strong>{{$goodswarehouse->supplier->s_phone}}</p>
                        <p><strong>Fax: </strong>{{$goodswarehouse->supplier->s_tax}}</p>
                        <p><strong>Tên ngân hàng: </strong>{{$goodswarehouse->supplier->s_name_bank}}</p>
                    </div>
                </th>
                <th width = "300px">
                    <div class="text">
                        <p><strong>Địa chỉ: </strong></strong>{{$goodswarehouse->supplier->s_address}}</p>
                        <p><strong>Email: </strong>{{$goodswarehouse->supplier->s_email}}</p>
                        <p><strong>Số tài khoản: </strong>{{$goodswarehouse->supplier->s_acc_number}}</p>
                    </div>
                </th>
            </tr>
        </thead>
    </table>

    <div class="center m-20 mt-50">
        <h2>PHIẾU NHẬP HÀNG</h2>
    </div>

    <div class="text">
        <p><strong>Người nhập: </strong></span><span>{{$user->name}} </p>
        <p><strong>Email: </strong></span><span>{{$user->email}} </p>
        <p><strong>Địa chỉ: </strong></span><span>Đại học Vinh - Viện Kỹ thuật & Công nghệ</p>
        <p><strong>Hình thức thanh toán: </strong></span><span></p>
    </div>
    <hr>

    <div class="text">
      <p><strong>Các thiết bị nhập hàng: </strong></span><span></p>
    </div>
    <table class="table_frame" cellpadding="3px">
        <thead>
            <tr>
                <td><strong>STT</strong></td>
                <td><strong>Tên thiết bị</strong></td>
                <td><strong>Mã TB</strong></td>
                <td><strong>ĐV tính</strong></td>
                <td width="120px"><strong>Đơn giá</strong></td>
                <td><strong>Số lượng</strong></td>
              <td width="120px"><strong>Thành tiền</strong></td>
              <td width="80px"><strong>Ghi chú</strong></td>
            </tr>
              
            </tr>
        </thead>
    
        <tbody>
            @php
                $count = 1;
            @endphp
                @foreach ($goodswarehouseDetail as $detail)
                <tr>
                    <td>{!! $count++ !!}</td>
                    <td>
                        <?php
                        $pd = DB::table('products')->where('id', $detail->wid_product_id)->first();
                        echo $pd->p_name;
                        ?>
                    </td>
                    <td>{!! $pd->p_code !!}</td>
                    <td>Cái</td>
                    <td>{!! number_format($pd->p_price, 0, ",", ".") !!} vnđ</td>
                    <td>{!! $detail->wid_quantity !!}</td>
                    <td>{!! number_format($detail->wid_total, 0, ",", ".") !!} vnđ</td>
                    <td></td>
                </tr>
            @endforeach
        
            <tr>
                <td></td>
                <td>Tổng tiền</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    {!! number_format($goodswarehouse->gw_total,0,",",".") !!} vnđ
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    ?>
    <div style="text-align: right;">
        <p>Nghệ An,<span>
            Ngày <?php echo date("d") ?>
            Tháng <?php echo date("m") ?>
            Năm <?php echo date("Y") ?>
        </span></p>
    </div>

    <table class="center">
        <tr>
            <td width="250px" class="writer-name"><strong>Người nhập hàng</strong></td>
            <td width="250px" class="writer-name"><strong>Người giao hàng</strong></td>
            <td width="250px" class="writer-name"><strong>Người lập phiếu</strong></td>
        </tr>
        <tr>
            <td>(Ký và ghi rõ họ tên)</td>
            <td>(Ký và ghi rõ họ tên)</td>
            <td><span>(Ký và ghi rõ họ tên)</span></td>
        </tr>
    </table>

</body>
</html>
