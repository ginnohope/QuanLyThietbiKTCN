<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu bảo trì và nghiêm thu</title>
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

      img {
        width: 100px;
      }

  </style>
  
</head>
<body class="container">

    <table class="table_frame">
        <thead>
            <tr>
                {{-- <img src="storage/images/DHV/logoDHV.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
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
        <h2>Biên bản bảo trì và nghiệm thu phòng máy</h2>
        <h2>Viện KT&CN trường Đại học Vinh</h2>
    </div>

    <div class="text">
        <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        ?>
        <p>Hôm nay,<span>
            Ngày <?php echo date("d") ?>
            Tháng <?php echo date("m") ?>
            Năm <?php echo date("Y") ?>
        </span></p>

        <p><strong>Bên A (Bên bảo trì): </strong></span><span>
        </p>
        <p><strong>Tên công ty: </strong></span><span>
            .............................................................................................................................................
        </p>
        <p><strong>Địa chỉ: </strong></span><span>
            ......................................................................................................................................................
        </p>
        <p><strong>Số điện thoại: </strong></span><span>
            ...........................................................................................................................................
        </p>
    </div>

    <table>
        <tr>
            <td width="120px"><strong>Do ông/Bà:</strong>........................................................</td>
            <td width="120px"><strong>Chức vụ:</strong>.....................................................................</td>
        </tr>
    </table>

    <div class="text">
        <p><strong>Bên B (Bên được bảo trì): </strong></span><span>
        </p>
        <p><strong>Tên Trường: </strong></span><span>
            Đại học Vinh
        </p>
        <p><strong>Địa chỉ: </strong></span><span>
            .....................................................................................................................................................
        </p>
        <p><strong>Thiết bị bảo trì thuộc: </strong></span><span>
        Viện Kỹ thuật và công nghệ, phòng {{$room->r_name}} - {{$room->floor->f_name}}
        </p>
        <p><strong>Số điện thoại: </strong></span><span>
            .........................................................................................................................................
        </p>
    </div>

    <table>
        <tr>
            <td width="300px"><strong>Người theo dõi bảo trì:</strong>............................................</td>
            <td width="300px"><strong>Thuộc bộ phận:</strong>.................................................</td>
        </tr>
    </table>

    <br>

    <div class="text">
      <h2><strong>Danh sách các thiết bị cần được bào trì: </strong></span><span></h2>
    </div>
    <table class="table_frame" cellpadding="3px">
        <thead>
            <tr>
                <td><strong>STT</strong></td>
                <td><strong>Tên thiết bị</strong></td>
                <td><strong>Mã TB</strong></td>
                <td><strong>Trạng thái</strong></td>
                <td><strong>Tình trạng</strong></td>
                <td width="200px"><strong>Mô tả hiện trạng</strong></td>
                <td><strong>Ghi chú</strong></td>
            </tr>
              
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($roomDetails as $item)
            <tr>
                <td>
                    @php
                    echo $i++;
                    @endphp
                </td>

                <td>{{$item->product->p_name}}</td>
                <td>{{$item->rd_code}}</td>
                @if($item->rd_state == 1)
                    <td>Hoạt động</td>
                @else
                    <td>Bảo trì</td>
                @endif

                @if($item->rd_Percentage == 1)
                    <td>Tốt</td>
                @elseif($item->rd_Percentage == 2)
                    <td>Kém</td>
                @else
                    <td>Hỏng</td>
                @endif
                <td>{{$item->rd_notes}}</td>
                <td></td>
            </tr>

            @endforeach
    </table>

    <div class="text">
        <p><strong>Lưu ý khi bảo trì: </strong></span><span>
            ........................................................................................................................................................................
            ........................................................................................................................................................................
            ........................................................................................................................................................................
            ........................................................................................................................................................................
            ........................................................................................................................................................................
        </p>
    </div>

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
            <td width="250px" class="writer-name"><strong>Bên bảo trì</strong></td>
            <td width="250px" class="writer-name"><strong>Quản lý phòng</strong></td>
        </tr>
        <tr>
            <td>(Ký và ghi rõ họ tên)</td>
            <td><span>(Ký và ghi rõ họ tên)</span></td>
            <td><span>(Ký và ghi rõ họ tên)</span></td>
        </tr>
    </table>
</body>
</html>