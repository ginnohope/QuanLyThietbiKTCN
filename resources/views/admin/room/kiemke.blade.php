<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu kiểm kê</title>
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
          size: A3;
          margin: 40px;
      }

      .m-20 {
        margin: 10px 0;
      }

      .text {
        text-align: left;
      }

      img {
        width: 100px;
      }

  </style>
  
</head>
<body class="container">

    <table class="table_frame">
        <thead>
            <tr>
                <img src="storage/images/DHV/logoDHV.png" alt="" class="brand-image elevation-3 img-circle" style="opacity: .8">
                <th width="300px">
                    TRƯỜNG ĐẠI HỌC VINH
                    <br>
                    Đơn vị: Viện kỹ thuật và công nghệ
                </th>
                <th>
                    <center>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM </center>
                    <center>Độc lập - Tự do - Hạnh phúc</center>
                </th>
            </tr>
        </thead>
    </table>

    <div class="center m-20">
        <h2>Biên bản kiểm kê tài sản phòng máy</h2>
        <h2>viện KT&CN trường Đại học Vinh</h2>
    </div>

    <div class="text">
        <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        ?>
        <p><strong>Thời gian kiểm kê: </strong><span>
            <?php echo date("H") ?> giờ 
            <?php echo date("i") ?> phút, 
            Ngày <?php echo date("d") ?>
            Tháng <?php echo date("m") ?>
            Năm <?php echo date("Y") ?>
        </span></p>

        <p><strong>Địa điểm: </strong></span><span>Phòng {{$room->r_name}} - {{$room->floor->f_name}}</p>
        <p><strong>Ban kiểm kê gồm: </strong></span><span></p>
    </div>

    <table>
        {{-- <tr>
          <td><strong>Ban kiểm kê gồm: </strong></td><td></td>
        </tr> --}}
        <tr>
            <td width="100px"><strong>Ông/Bà:</strong></td> <td></td>
            <td width="100px"><strong>Chức vụ:</strong></td> <td></td>
        </tr>
        <tr>
          <td width="150px"><strong>Ông/Bà:</strong></td> <td></td>
          <td width="150px"><strong>Chức vụ:</strong></td> <td></td>
        </tr>
    </table>

    <div class="text">
      <p><strong>Đã kiểm kê phòng máy có những thiết bị dưới đây: </strong></span><span></p>
    </div>
    <table class="table_frame" cellpadding="3px">
        <thead>
            <tr>
                <td rowspan="2"><strong>STT</strong></td>
                <td rowspan="2"><strong>Mã TB</strong></td>
                <td rowspan="2"><strong>Tên thiết bị</strong></td>
                <td rowspan="2"><strong>ĐV tính</strong></td>
                <td width='130px' rowspan="2"><strong>Đơn giá</strong></td>
                <td colspan="2"><strong>Theo sổ sách</strong></td>
                <td colspan="2"><strong>Theo kiểm kê</strong></td>
                <td colspan="2"><strong>Trạng thái</strong></td>
                <td colspan="3"><strong>Tình trạng</strong></td> 
            </tr>
            <tr>
              <td><strong>Số lượng</strong></td>
              <td><strong>Thành tiền</strong></td>
              <td><strong>Số lượng</strong></td>
              <td width='130px'><strong>Thành tiền</strong></td>
              <td><strong>Hoạt động</strong></td>
              <td><strong>Bảo trì</strong></td>
              <td><strong>Tốt</strong></td>
              <td><strong>Kém</strong></td>
              <td><strong>Hỏng</strong></td>
            <tr>
              
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($combinedProducts as $product)
            <tr>
                <td>
                    @php
                    echo $i++;
                    @endphp
                </td>
                <td>{{ $product['product']->p_code }}</td>
                <td>{{ $product['product']->p_name }}</td>
                <td>Cái</td>
                <td>
                    {!! number_format($product['product']->p_price,0,",",".") !!} vnđ
                </td>
                <td></td>
                <td></td>
                <td>{{ $product['quantity'] }}</td>
                <td>
                    {!! number_format($product['total'],0,",",".") !!} vnđ
                </td>
                <td>{{ $product['State1'] }}</td>
                <td>{{ $product['State0'] }}</td>
                <td>{{ $product['status1'] }}</td>
                <td>{{ $product['status2'] }}</td>
                <td>{{ $product['status3'] }}</td>
            </tr>

            @endforeach
            <tr>
                <td>X</td>
                <td>Tổng tiền</td>
                <td>X</td>
                <td>X</td>
                <td>X</td>
                <td>X</td>
                <td></td>
                <td>X</td>
                <td>
                    {!! number_format($tong,0,",",".") !!} vnđ
                </td>
                <td>X</td>
                <td>X</td>
                <td>X</td>
                <td>X</td>
                <td>X</td>
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
            <td width="250px" class="writer-name"><strong>Viện trưởng</strong></td>
            <td width="250px" class="writer-name"><strong>Trưởng kế toán</strong></td>
            <td width="250px" class="writer-name"><strong>Trưởng ban kiểm kê</strong></td>
            <td width="250px" class="writer-name"><strong>Quản lý phòng</strong></td>
        </tr>
        <tr>
            <td>(Ký và ghi rõ họ tên)</td>
            <td>(Ký và ghi rõ họ tên)</td>
            <td><span>(Ký và ghi rõ họ tên)</span></td>
            <td><span>(Ký và ghi rõ họ tên)</span></td>
        </tr>
    </table>

</body>
</html>