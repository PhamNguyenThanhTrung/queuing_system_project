<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\nhatky;
use App\Models\Dichvu;
use App\Models\ThietBi;
use App\Models\Capso;
use App\Models\Avatar;
use App\Models\Member;
use App\Models\PassWordRS;
use App\Models\Rspass;
use App\Models\Vaitro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Traits\SendsPasswordResetEmailsTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

// dd();

class MyController extends Controller
{
    //biểu đồ
    public function showDashboard(Request $r)
    {

        $numbers = Capso::get();
        $numberCount = $numbers->count(); //Đếm số lượng numberid
        $numberCount_dangcho = $numbers->where('TinhTrang', 'Đang chờ')->count(); //Đếm số lượng numberid có trạng thái là "Đang chờ"
        $numberCount_dasudung = $numbers->where('TinhTrang', 'Đã sử dụng')->count(); // Đếm số lượng numberid có trạng thái là "Đã sử dụng"
        $numberCount_boqua = $numbers->where('TinhTrang', 'Bỏ qua')->count(); //Đếm số lượng numberid có trạng thái là "Bỏ qua"
        $totalNumbers = $numberCount_dangcho + $numberCount_dasudung + $numberCount_boqua;

        if ($totalNumbers == 0) {
            $numberCount_dasudung_pt = 0; //Tính phần trăm của cấp số đang "Đã sử dụng"
            $numberCount_dangcho_pt = 0; //Tính phần trăm của cấp số đang "Đang chờ"
            $numberCount_boqua_pt = 0; //Tính phần trăm của cấp số đang "Bỏ qua"

        } else {
            $numberCount_dasudung_pt = round(($numberCount_dasudung / $totalNumbers) * 100); //Tính phần trăm của cấp số đang "Đã sử dụng"
            $numberCount_dangcho_pt = round(($numberCount_dangcho / $totalNumbers) * 100); //Tính phần trăm của cấp số đang "Đang chờ"
            $numberCount_boqua_pt = round(($numberCount_boqua / $totalNumbers) * 100); //Tính phần trăm của cấp số đang "Bỏ qua"

        }

        $devices = ThietBi::get();
        $deviceCount = $devices->count(); //Đếm số lượng deviceid

        $deviceCount_hoatdong = $devices->where('Tinhtrang', 'Hoạt động')->count(); //Đếm số lượng memberid có trạng thái là "Hoạt động"
        $deviceCount_ngunghoatdong = $devices->where('Tinhtrang', 'Ngưng hoạt động')->count(); //Đếm số lượng memberid có trạng thái là "Ngưng hoạt động"
        $totalDevices = $deviceCount_hoatdong + $deviceCount_ngunghoatdong;
        if ($totalDevices == 0) {
            $deviceCount_hoatdong_pt = 0; //Tính phần trăm của dịch vụ đang "Hoạt động"
            $deviceCount_ngunghoatdong_pt = 0; //Tính phần trăm của dịch vụ đang "Ngưng hoạt động"
        }
        else
        {
            $deviceCount_hoatdong_pt = round(($deviceCount_hoatdong / $totalDevices) * 100); //Tính phần trăm của thiết bị đang "Hoạt động"
        $deviceCount_ngunghoatdong_pt = round(($deviceCount_ngunghoatdong / $totalDevices) * 100); //Tính phần trăm của thiết bị đang "Ngưng hoạt động"

        }

        $services = Dichvu::get();
        $serviceCount = $services->count(); //Đếm số lượng serviceid

        $serviceCount_hoatdong = $services->where('Tinhtrang', 'Hoạt động')->count(); //Đếm số lượng serviceid có trạng thái là "Hoạt động"
        $serviceCount_ngunghoatdong = $services->where('Tinhtrang', 'Ngưng hoạt động')->count(); //Đếm số lượng serviceid có trạng thái là "Ngưng hoạt động"
        $totalServices = $serviceCount_hoatdong + $serviceCount_ngunghoatdong;
        if ($totalServices == 0) {
            $serviceCount_hoatdong_pt = 0; //Tính phần trăm của dịch vụ đang "Hoạt động"
            $serviceCount_ngunghoatdong_pt = 0; //Tính phần trăm của dịch vụ đang "Ngưng hoạt động"
        }
        else {

            $serviceCount_hoatdong_pt = round(($serviceCount_hoatdong / $totalServices) * 100); //Tính phần trăm của dịch vụ đang "Hoạt động"
            $serviceCount_ngunghoatdong_pt = round(($serviceCount_ngunghoatdong / $totalServices) * 100); //Tính phần trăm của dịch vụ đang "Ngưng hoạt động"

        }

        ///////////////
        // Lọc ngày, tháng và năm
        $ChonNgay = $r->input('filterDate');
        $currentMonth = date('m');
        $currentYear = date('Y');
        $SoNgay = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $labels = [];
        $counts = [];
        if ($ChonNgay == 'Tháng') {
            for ($month = 1; $month <= 12; $month++) {
                $startDate = date('Y-m-d', strtotime("$currentYear-$month-01"));
                $endDate = date('Y-m-t', strtotime("$currentYear-$month-01"));
                $ticketsOfMonth = Capso::whereBetween('created_at', [$startDate, $endDate])->get();
                $count = count($ticketsOfMonth);
                $labels[] = date('M', strtotime($startDate));
                $counts[] = $count;
            }
        } elseif ($ChonNgay == 'Năm') {
            $startYear = $currentYear - 4;
            $endYear = $currentYear;
            for ($year = $startYear; $year <= $endYear; $year++) {
                $startDate = date('Y-m-d', strtotime("$year-01-01"));
                $endDate = date('Y-m-t', strtotime("$year-12-01"));
                $ticketsOfYear = Capso::whereBetween('created_at', [$startDate, $endDate])->get();
                $count = count($ticketsOfYear);
                $labels[] = $year;
                $counts[] = $count;
            }
        } else {
            for ($day = 1; $day <= $SoNgay; $day++) {
                $date = sprintf('%d-%02d-%02d', $currentYear, $currentMonth, $day);
                $ticketsOfDay = Capso::whereDate('created_at', $date)->get();
                $count = count($ticketsOfDay);
                $labels[] = sprintf('%02d', $day);
                $counts[] = $count;
            }
        }



        return view('Menu.dashboard', [
            'bieudo' => $numbers,
            //Cấp số
            'numberCount' => $numberCount,
            'numberCount_dangcho' => $numberCount_dangcho,
            'numberCount_dasudung' => $numberCount_dasudung,
            'numberCount_boqua' => $numberCount_boqua,
            'numberCount_dasudung_pt' => $numberCount_dasudung_pt,
            'numberCount_dangcho_pt' => $numberCount_dangcho_pt,
            'numberCount_boqua_pt' => $numberCount_boqua_pt,
            //Thiết bị
            'deviceCount' => $deviceCount,
            'deviceCount_hoatdong' => $deviceCount_hoatdong,
            'deviceCount_ngunghoatdong' => $deviceCount_ngunghoatdong,
            'deviceCount_hoatdong_pt' => $deviceCount_hoatdong_pt,
            //Dịch vụ
            'serviceCount' => $serviceCount,
            'serviceCount_hoatdong' => $serviceCount_hoatdong,
            'serviceCount_ngunghoatdong' => $serviceCount_ngunghoatdong,
            'serviceCount_hoatdong_pt' => $serviceCount_hoatdong_pt,



            'labels' => $labels,
            'counts' => $counts,
            'currentDay' => date('d'),
            'currentMonth' => date('F'),
            'currentYear' => date('Y'),
        ]);
    }


    public function statistics()
    {
        $months = $this->generateMonths(4); // Số tháng bạn muốn thống kê

        $data = [];
        $labels = [];

        foreach ($months as $month) {
            $year = $month['year'];
            $month = $month['month'];

            $daysInMonth = $this->generateDaysInMonth($year, $month);

            foreach ($daysInMonth as $day) {
                $startDate = Carbon::create($year, $month, $day)->startOfDay();
                $endDate = Carbon::create($year, $month, $day)->endOfDay();

                $count = DB::table('grant')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count();

                $data[] = $count;
                $labels[] = $day . '/' . $month . '/' . $year;
            }
        }

        return view('Menu.dashboard', ['data' => $data, 'labels' => $labels]);
    }

    public function generateDaysInMonth($year, $month)
    {
        $daysInMonth = [];

        $startDate = Carbon::create($year, $month, 1);
        $endDate = Carbon::create($year, $month)->endOfMonth();

        while ($startDate->lte($endDate)) {
            $daysInMonth[] = $startDate->day;
            $startDate->addDay();
        }

        return $daysInMonth;
    }


    private function generateMonths($numMonths)
    {
        $months = [];

        $start = Carbon::now()->subMonths($numMonths)->startOfMonth();

        for ($i = 0; $i < $numMonths; $i++) {
            $end = $start->copy()->endOfMonth();

            $months[] = [
                'month' => $start->format('m'),
                'year' => $start->format('Y'),
                'start' => $start,
                'end' => $end,
            ];

            $start->addMonth();
        }

        return $months;
    }

    public function index()
    {
        $statistics = Capso::select(DB::raw('COUNT(*) as total'), 'STT')
            ->groupBy('STT')
            ->get();

        $labels = $statistics->pluck('STT');
        $data = $statistics->pluck('total');

        return view('Menu.dashboard', compact('data', 'labels'));
    }
    public function showNhatky(Request $request)
    {
        $query = nhatky::query();

        $thoigian_dau = $request->input('thoigian_dau');
        $thoigian_cuoi = $request->input('thoigian_cuoi');
        $keyword = $request->input('timkiem');

        if ($thoigian_dau && $thoigian_cuoi) {
            $query->whereBetween('Impact_time', [$thoigian_dau, $thoigian_cuoi]);
        }

        if ($keyword) {
            $query->where('Name_DN', 'like', "%$keyword%");
        }

        // Số phần tử hiển thị trên mỗi trang
        $perPage = 10;

        // Lấy dữ liệu từ cơ sở dữ liệu sử dụng phân trang
        $paginatelog = $query->paginate($perPage);

        $data = [
            'nhatkyes' => $paginatelog,
            'thoigian_dau' => $thoigian_dau,
            'thoigian_cuoi' => $thoigian_cuoi,
            'timkiem' => $keyword,
        ];

        return view('Menu.nhatky', $data);
    }

// nhật ký thao tác
    public function createLog($action)
    {
        $log = new nhatky();
        $log->Name_DN = Auth::user()->MemberName; // Tên của dịch vụ hoặc trang
        $ipAddress = getHostByName(getHostName());
        $log->host = $ipAddress;

        $log->operation = $action; // Thao tác
        $log->member_id = Auth::user()->MemberID; // ID của người dùng
        $log->Impact_time = now(); // Thời gian thực hiện thao tác


        $log->save();
    }
 
    //upload ảnh
    public function uploadAvatar(Request $request)
    {
        // Validate input data
        $request->validate([
            'Name_Img' => 'required',
        ]);

        // Lấy thông tin về tệp tin
        $image = $request->file('Name_Img');
        $imageInfo = getimagesize($image->getPathname());
        $imageMime = $imageInfo['mime'];

        // Kiểm tra nếu không phải là hình ảnh hợp lệ
        if (!in_array($imageMime, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])) {
            // Xử lý lỗi
            return redirect()->back()->withErrors(['Name_Img' => 'The name image field must be an image.']);
        }

        // Lưu ảnh vào thư mục storage/app/public/avatar
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/avatar', $imageName);

        // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
        // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
        $memberID = Auth::user()->MemberID;
        $avatar = Avatar::where('member_id', $memberID)->first();

        if ($avatar) {
            $avatar->Name_Img = 'storage/app/public/avatar/' . $imageName;

            $avatar->save();
        } else {
            $avatar = new Avatar();
            $avatar->member_id = $memberID;
            $avatar->Name_Img = 'storage/app/public/avatar/' . $imageName;
            $avatar->save();
        }

        $this->createLog('Cập nhật Ảnh đại diện mới ' . $memberID); // Gọi phương thức createLog và truyền tham số là tên thao tác

        // Redirect hoặc trả về phản hồi thành công
        return view('personalaccount')->with('avatar', $avatar)->with('success', 'Thêm vai trò thành công');
    }








    public function downloadData()
    {
        // Lấy dữ liệu từ cơ sở dữ liệu
        $data = Capso::all();

        if ($data->isEmpty()) {
            return redirect('/')->with('error', 'Không có dữ liệu để tải về.');
        }

        // Tạo nội dung dữ liệu
        $content = 'STT, Tên Dịch Vụ , Thời Gian Cấp, Tình Trạng , Nguồn Cấp' . "\n"; // Tên cột

        $currentTime = Carbon::now();

        foreach ($data as $row) {
            if ($currentTime > $row->expired_at) {
                $TinhTrang = 'Bỏ qua';
            } else if ($currentTime < $row->created_at->addMinutes(15)) {
                $TinhTrang = 'Đã sử dụng';
            } else {
                $TinhTrang = 'Đang chờ';
            }


            $content .= $row->STT . ',' . $row->Name_Dv . ',' . $row->created_at . ',' . $TinhTrang . ',' . $row->source . "\n";
        }

        // Tạo tên tệp tin và đường dẫn lưu trữ
        $fileName = 'BaoCao.csv';
        $filePath = 'exports/' . $fileName;

        // Lưu nội dung vào tệp tin
        Storage::put($filePath, $content);
        $this->createLog('Tải file bảng Báo cáo ' . $fileName); // Gọi phương thức createLog và truyền tham số là tên thao tác
        // Trả về phản hồi để tải về tệp tin
        return response()->download(storage_path('app/' . $filePath), $fileName);
    }





//show vai trò
    public function showvaitro(Request $request)
    {
        $members = Member::all();
        $vaitros = Vaitro::all();

        foreach ($vaitros as $vaitro) {
            $totalOccurrences = $members->where('Vaitro', $vaitro->Name_VT)->count();
            $vaitro->totalMembers = $totalOccurrences;
            $vaitro->save();
        }

        $data = [
            'vaitros' => $vaitros,
            'members' => $members,
        ];

        return view('Menu.Quanlyvaitro.quanlyvaitro', $data);
    }


    public function updateVaitroCounts(request $request)
    {
        $vaitros = Vaitro::all();
        $members = Member::all();
        foreach ($vaitros as $vaitro) {
            $vaitroName = $vaitro->Name_VT;
            $memberCount = Member::where('Vaitro', $vaitroName)->count();

            $vaitro->So_nguoi = $memberCount;


            $vaitro->save();
        }
        $this->createLog('Cập nhật vai trò với mã số ' . $request->ID_VT); // Gọi phương thức createLog và truyền tham số là tên thao tác
        return redirect('/Vaitro')->with('success', 'Cập nhật vai trò thành công');
    }

    //thêm vai trò
    public function ThemVT(Request $request)
    {
        // Validate input data
        $data = $request->validate([
            'Name_VT' => 'required|unique:role',
            'source' => 'required',
            'Nhom_A' => 'required',
            'Nhom_B' => '',
            'member_id'
        ]);

        // Find member by Member_ID and password, or return error message

        // Convert array values to comma-separated string
        $nhomA = implode(',', $data['Nhom_A']);

        // Add 'Nhom_A' value to $data
        $data['Nhom_A'] = $nhomA;

        // Create new Vaitro record with member_id
        $vaitro = new Vaitro($data);

        $vaitro->save();
        $this->createLog('Thêm vai trò dịch vụ với mã số ' . $request->ID_VT);
        $members = Member::where('Vaitro', $request->input('Name_VT'))->update(['Nhom_A' => $vaitro->Nhom_A]);

        if ($members) {
            $members->Nhom_A = $vaitro->Nhom_A;
            $members->save();
        }
        // Redirect to Vaitro page with success message
        return redirect('/Vaitro')->with('success', 'Thêm vai trò thành công');
    }


    public function editVT($ID_VT)
    {

        $vaitro = Vaitro::find($ID_VT);

        if (!$vaitro) {
            return response()->json(['error' => 'Thiết bị không tồn tại'], 404);
        }
        return view('Menu/Quanlyvaitro/capnhatvaitro', compact('vaitro'));
    }


//update vai trò
    public function updateVT(Request $request, $ID_VT)
    {
        $data = $request->validate([
            'Name_VT' => 'required',
            'source' => 'required',
            'Nhom_A' => 'required',
            'Nhom_B' => '',
            'member_id'
        ]);

        $vaitro = Vaitro::find($ID_VT);

        $vaitro->Name_VT = $request->input('Name_VT');
        $vaitro->source = $request->input('source');
        $vaitro->Nhom_A = implode(',', $request->input('Nhom_A')); // Chuyển đổi mảng thành chuỗi



        $vaitro->save();
        $members = Member::where('Vaitro', $request->input('Name_VT'))->update(['Nhom_A' => $vaitro->Nhom_A]);



        $this->createLog('Cập nhật thông tin Vai trò với mã số ' . $request->ID_VT);

        return redirect('/Vaitro')->with('success', 'Cập nhật Vai trò thành công');
    }


    public function showBaocao(Request $request)
    {
        $query = Capso::query();
        $thoigian_dau = null;
        $thoigian_cuoi = null;
        $keyword = null;

        if ($request->has('tendv')) {
            $tendv = $request->tendv;

            if ($tendv !== 'Tất cả') {
                $query->where('Name_Dv', $tendv);
            }
        }
        if ($request->has('timkiem')) {
            $keyword = $request->timkiem;
            $query->where('MemberName', 'like', "%$keyword%");
        }

        if ($request->has('thoigian_dau') && $request->has('thoigian_cuoi')) {
            $thoigian_dau = $request->thoigian_dau;
            $thoigian_cuoi = $request->thoigian_cuoi;

            $query->whereBetween('created_at', [$thoigian_dau, $thoigian_cuoi]);
        }
        // Số phần tử hiển thị trên mỗi trang
        $perPage = 10;

        // Lấy dữ liệu từ cơ sở dữ liệu sử dụng phân trang
        $capsos = $query->paginate($perPage);


        $data = [
            'capsos' => $capsos,
            'thoigian_dau' => $thoigian_dau,
            'thoigian_cuoi' => $thoigian_cuoi,
            'timkiem' => $keyword,
        ];

        return view('Menu.Baocao.baocao', $data);
    }

    public function showchitietCS($STT)
    {
        $capso = Capso::where('STT', (int)$STT)->first();
        $capso->sdt = Auth::user()->Tel;
        $capso->email = Auth::user()->Email;
        return view('Menu/Capso/ctcapso', compact('capso'));
    }
    public function showcapso(Request $request)
    {
        $query = Capso::query();
        $thoigian_dau = $request->input('thoigian_dau');
        $thoigian_cuoi = $request->input('thoigian_cuoi');
        $keyword = $request->input('timkiem');

        if ($request->has('source')) {
            $hoatdong = $request->input('source');

            if ($hoatdong === 'Kiosk') {
                $query->where('source', 'Kiosk');
            } elseif ($hoatdong === 'Display counter') {
                $query->where('source', 'Display counter');
            }
        }


        if ($request->has('Tinhtrang')) {
            $hoatdong = $request->input('Tinhtrang');

            if ($hoatdong === 'Đang chờ') {
                $query->where('Tinhtrang', 'Đang chờ');
            } elseif ($hoatdong === 'Đã sử dụng') {
                $query->where('Tinhtrang', 'Đã sử dụng');
            } elseif ($hoatdong === 'Bỏ qua') {
                $query->where('Tinhtrang', 'Bỏ qua');
            } elseif ($hoatdong === 'Tất cả') {
                // Không áp dụng bất kỳ điều kiện lọc nào với trường Tinhtrang
            }
        }

        if ($thoigian_dau && $thoigian_cuoi) {
            $query->whereBetween('created_at', [$thoigian_dau, $thoigian_cuoi]);
        }

        if ($keyword) {
            $query->where('MemberName', 'like', "%$keyword%");
        }

        $dichvus = $query->get();


        if ($request->has('tendv')) {
            $tendv = $request->tendv;

            if ($tendv !== 'Tất cả') {
                $query->where('Name_Dv', $tendv);
            }
        }
        if ($request->has('timkiem')) {
            $keyword = $request->timkiem;
            $query->where('MemberName', 'like', "%$keyword%");
        }

        // Số phần tử hiển thị trên mỗi trang
        $perPage = 10;

        // Lấy dữ liệu từ cơ sở dữ liệu sử dụng phân trang
        $capsos = $query->paginate($perPage);

        //phân trang
        if ($request->has('thoigian_dau') && $request->has('thoigian_cuoi')) {
            $thoigian_dau = $request->thoigian_dau;
            $thoigian_cuoi = $request->thoigian_cuoi;

            $query->whereBetween('created_at', [$thoigian_dau, $thoigian_cuoi]);
        }
$dichvus=Dichvu::all();

        $capsos->appends($request->query());



        $data = [
            'capsos' => $capsos,
            'thoigian_dau' => $thoigian_dau,
            'thoigian_cuoi' => $thoigian_cuoi,
            'timkiem' => $keyword,
            'dichvus' => $dichvus,
        ];

        return view('Menu.Capso.capso', $data);
    }


    public function editCapsomoi(){

        $dichvus=Dichvu::all();



        return view('Menu.Capso.capsomoi', ['dichvus' => $dichvus]);

    }

// thêm số mới
    public function Capsomoi(Request $request)
    {
        // Validate input data
        $data = $request->validate([
            'Name_Dv' => 'required',
        ], [
            'Name_Dv.required' => 'Vui lòng chọn Tên dịch vụ',
        ]);


        $MemberID = Auth::id();
        $member = Member::find($MemberID);
        $thietbi = ThietBi::where('member_id', $MemberID)->first();

        if (!$member) {
            return redirect('/Capsomoi')->withErrors('Tài khoản không tồn tại');
        }

        if (!$thietbi) {
            return redirect('/Capsomoi')->withErrors('Vui lòng thêm thiết bị trước cho tài khoản này mới được cấp số');
        }


        $Capso = new Capso($data);
        $Capso->member_id = $MemberID;
        $Capso->ID_Tb = $thietbi->ID_Tb;
        $random_hours = rand(4, 12);
        $expired_at = now()->addHours($random_hours);
        $Capso->expired_at = $expired_at;
        $Capso->source = $thietbi->Loai_Tb;

        $currentTime = now();
        if ($currentTime > $request->expired_at) {
            $Capso->Tinhtrang = 'Bỏ qua';
        } else if ($currentTime < $request->created_at->addMinutes(15)) {
            $Capso->Tinhtrang = 'Đã sử dụng';
        } else {
            $Capso->Tinhtrang = 'Đang chờ';
        }




        $Capso->MemberName = Auth::user()->MemberName;
        $Capso->ID_Tb = $thietbi->ID_Tb;

        $Capso->save();
        $data = [
            'Capsomoi' =>   $Capso
        ];

        $this->createLog('Cấp 1 số mới với số thứ tự ' . $Capso->STT); // Gọi phương thức createLog và truyền tham số là tên thao tác


        return redirect('/Capsomoi')->with('Capsomoi', $Capso);
    }



    public function showtaikhoan(Request $request)
    {
        $query = Member::query();
        $keyword = $request->input('timkiem');
        $perPage = 5;

        if ($request->has('Vaitro')) {
            $Vaitro = $request->Vaitro;

            if ($Vaitro !== 'Tất cả') {
                $query->where('Vaitro', $Vaitro);
            }
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('MemberName', 'like', "%$keyword%")
                    ->orWhere('MemberID', 'like', "%$keyword%")
                    ->orWhere('UserDN', 'like', "%$keyword%");
            });
        }

        $members = $query->paginate($perPage);
        $members->appends($request->query());
$Vaitro=Vaitro::all();
        $data = [
            'members' => $members,
            'timkiem' => $keyword,
            'vaitro' => $Vaitro,
        ];

        return view('Menu.Quanlytaikhoan.quanlytaikhoan', $data);
    }
    
    //edit thêm tài khoản
    public function ThemTk1(Request $request)
    {
        // Các xử lý thêm tài khoản

        $vaitro = Vaitro::all(); // Lấy danh sách các vai trò

        // Truyền biến $vaitro vào view khi trả về
        return view('Menu.Quanlytaikhoan.Themtaikhoan', ['vaitro' => $vaitro]);
    }
    public function ThemTk(Request $request)
    {

        // Kiểm tra và validate dữ liệu từ request
        $data = $request->validate([
            'MemberName' => 'required',
            'UserDN' => 'required|unique:members',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'Tel' => 'required|unique:members',
            'Email' => 'required|email|unique:members',
            'Vaitro' => 'required',
            'Nhom_A' => '',
            'Tinhtrang' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']); // Mã hóa mật khẩu

        $members = new Member($data);

        $vaitro = Vaitro::where('Name_VT', $request->input('Vaitro'))->first();

        $members = new Member($data);

        if ($vaitro) {
            $members->Nhom_A = $vaitro->Nhom_A;
        }


        $members->save();
        $this->createLog('Thêm 1 tài khoản với mã số ' . $request->MemberID); // Gọi phương thức createLog và truyền tham số là tên thao tác


        // Redirect hoặc trả về response tương ứng
        return redirect('/quanlytaikhoan', )->with('success', 'Thêm tài khoản thành công');
    }


    public function editTK($MemberID)
    {
        $member = Member::find($MemberID);

        if (!$member) {
            return response()->json(['error' => 'Dịch Vụ không tồn tại'], 404);
        }

        return view('Menu/Quanlytaikhoan/updatetaikhoan', compact('member'));
    }

    //dichvu
    public function updateTK(Request $request, $MemberID)
    {

        $member = Member::find($MemberID);
        // Kiểm tra và validate dữ liệu từ request


        $data = $request->validate([
            'MemberName' => 'required',
            'UserDN' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password', // Kiểm tra trường confirm_password phải giống password
            'Tel' => 'required',
            'Email' => 'required',
            'Vaitro' => 'required',
            'Tinhtrang' => 'required',
        ], [
            'confirm_password.same' => 'Trường nhập lại mật khẩu phải giống với mật khẩu',
        ]);
        // Tìm thành viên cần cập nhật


        // Cập nhật thông tin thành viên
        // Cập nhật thông tin thành viên
        $member->MemberName = $data['MemberName'];
        $member->UserDN = $data['UserDN'];
        $member->password = bcrypt($data['password']); // Sử dụng bcrypt() để tạo hash mật khẩu mới
        $member->Tel = $data['Tel'];
        $member->Email = $data['Email'];
        $member->Vaitro = $data['Vaitro'];
        $member->Tinhtrang = $data['Tinhtrang'];



        $member->save();
        $this->createLog('Cập nhật thông tin tài khoản với mã số ' . $request->MemberID); // Gọi phương thức createLog và truyền tham số là tên thao tác

        return redirect('/quanlytaikhoan')->with('success', 'Cập nhật tài khoản thành công');
    }



    public function editDV($ID_Dv)
    {
        $dichvu = Dichvu::find($ID_Dv);

        if (!$dichvu) {
            return response()->json(['error' => 'Dịch Vụ không tồn tại'], 404);
        }

        return view('Menu/Dichvu/capnhatdichvu', compact('dichvu'));
    }

    //dichvu
// update dịch vụ
    public function updateDV(Request $request, $ID_Dv)
    {
        $data = $request->validate([
            'code_Dv' => 'required|unique:service,code_Dv,'.$ID_Dv.',ID_Dv',
            'Name_Dv' => 'required|unique:service,Name_Dv,'.$ID_Dv.',ID_Dv',
            'Describe_Dv' => 'required',
            'Rules_of_grant' => 'required',
        ], [
        'code_Dv.unique' => 'Tên Name_Dv đã tồn tại.',
          'Name_Dv.unique' => 'Tên Name_Dv đã tồn tại.',
            'Rules_of_grant.required' => 'Vui lòng nhập Rules_of_grant.',
        ]);

        $user = Auth::user();
        $Rules_of_grant = implode(',', $request->input('Rules_of_grant')); // Lấy giá trị của Rules_of_grant từ request
        $data['Rules_of_grant'] = $Rules_of_grant;



        $dichvu = Dichvu::find($ID_Dv);

        $dichvu->code_Dv = $request->input('code_Dv');
        $dichvu->Name_Dv = $request->input('Name_Dv');
        $dichvu->Describe_Dv = $request->input('Describe_Dv');
        $dichvu->Rules_of_grant = $data['Rules_of_grant']; // Gán giá trị Rules_of_grant từ $data vào model

        $dichvu->save();
        $this->createLog('Cập nhật 1 dịch vụ với mã số' . $request->code_Dv);


        return redirect('/Dichvu')->with('success', 'Cập nhật dịch vụ thành công');
    }

//show chi tiết dịch vụ
    public function showchitietDV(Request $request, $ID_Dv)
    {
        $query = Capso::query();
        $thoigian_dau = $request->input('thoigian_dau');
        $thoigian_cuoi = $request->input('thoigian_cuoi');
        $keyword = $request->input('timkiem');

        $dichvu = Dichvu::where('ID_Dv', (int)$ID_Dv)->first();



        if ($request->has('Tinhtrang')) {
            $hoatdong = $request->input('Tinhtrang');

            if ($hoatdong === 'Đang chờ') {
                $query->where('Tinhtrang', 'Đang chờ');
            } elseif ($hoatdong === 'Đã sử dụng') {
                $query->where('Tinhtrang', 'Đã sử dụng');
            } elseif ($hoatdong === 'Bỏ qua') {
                $query->where('Tinhtrang', 'Bỏ qua');
            } elseif ($hoatdong === 'Tất cả') {
                // Không áp dụng bất kỳ điều kiện lọc nào với trường Tinhtrang
            }
        }

        if ($thoigian_dau && $thoigian_cuoi) {
            $query->whereBetween('created_at', [$thoigian_dau, $thoigian_cuoi]);
        }


        // Bộ lọc tìm kiếm theo STT
        if ($request->has('timkiem')) {
            $STT = $request->input('timkiem');
            $query->where('STT', 'like', '%' . $STT . '%');
        }


        $dichvus = $query->get();


        if ($request->has('tendv')) {
            $tendv = $request->tendv;

            if ($tendv !== 'Tất cả') {
                $query->where('Name_Dv', $tendv);
            }
        }
        if ($request->has('timkiem')) {
            $keyword = $request->timkiem;
            $query->where('MemberName', 'like', "%$keyword%");
        }

        // Số phần tử hiển thị trên mỗi trang
        $perPage = 10;

        // Lấy dữ liệu từ cơ sở dữ liệu sử dụng phân trang
        $capsos = $query->paginate($perPage);

        //phân trang
        if ($request->has('thoigian_dau') && $request->has('thoigian_cuoi')) {
            $thoigian_dau = $request->thoigian_dau;
            $thoigian_cuoi = $request->thoigian_cuoi;

            $query->whereBetween('created_at', [$thoigian_dau, $thoigian_cuoi]);
        }


        $capsos->appends($request->query());



        $data = [
            'capsos' => $capsos,
            'thoigian_dau' => $thoigian_dau,
            'thoigian_cuoi' => $thoigian_cuoi,
            'timkiem' => $keyword,
        ];


        return view('Menu/Dichvu/ctdichvu1', compact('dichvu'), $data);
    }






    public function showdichvu(Request $request)
    {
        $query = Dichvu::query();

        $thoigian_dau = $request->input('thoigian_dau');
        $thoigian_cuoi = $request->input('thoigian_cuoi');
        $keyword = $request->input('timkiem');

        if ($request->has('hoatdong')) {
            $hoatdong = $request->input('hoatdong');

            if ($hoatdong === 'Hoạt động') {
                $query->where('Tinhtrang', 'Hoạt động');
            } elseif ($hoatdong === 'Ngừng hoạt động') {
                $query->where('Tinhtrang', 'Ngừng hoạt động');
            } elseif ($hoatdong === 'Tất cả') {
                // Không áp dụng bất kỳ điều kiện lọc nào với trường Tinhtrang
            }
        }

        if ($thoigian_dau && $thoigian_cuoi) {
            $query->whereBetween('created_at', [$thoigian_dau, $thoigian_cuoi]);
        }

        if ($keyword) {
            $query->where('Name_Dv', 'like', "%$keyword%");
            $query->orwhere('code_Dv', 'like', "%$keyword%");
        }

        // Số phần tử hiển thị trên mỗi trang
        $perPage = 10;

        // Lấy dữ liệu từ cơ sở dữ liệu sử dụng phân trang
        $dichvus = $query->paginate($perPage);



        $data = [
            'dichvus' => $dichvus,
            'thoigian_dau' => $thoigian_dau,
            'thoigian_cuoi' => $thoigian_cuoi,
            'timkiem' => $keyword,
        ];

        return view('Menu/Dichvu/dichvu', $data);
    }





    public function ThemDV(Request $request)
    {
        // Validate input data



        $data = $request->validate([
            'code_Dv' => 'required|unique:service',
            'Name_Dv' => 'required|unique:service',
            'Describe_Dv' => 'required',
            'Rules_of_grant' => 'required',
        ], [
            'Rules_of_grant.required' => 'Vui lòng nhập Rules_of_grant.',
        ]);


        $user = Auth::user();
        $Rules_of_grant = implode(',', $data['Rules_of_grant']);
        $data['Rules_of_grant'] = $Rules_of_grant;


        $dichvu = new Dichvu($data);
        $dichvu->Tinhtrang = $user->Tinhtrang;
        $dichvu->member_id = $user->MemberID;
        $dichvu->save();
        $this->createLog('Thêm 1 dịch vụ với mã số' . $request->code_Dv); // Gọi phương thức createLog và truyền tham số là tên thao tác

        return redirect('/Dichvu')->with('success', 'Thêm dịch vụ thành công');
    }




    // thiết bị
    public function editThietBi($ID_Tb)
    {

        $thietbi = ThietBi::find($ID_Tb);

        if (!$thietbi) {
            return response()->json(['error' => 'Thiết bị không tồn tại'], 404);
        }
        return view('Menu/Thietbi/updateTB', compact('thietbi'));
    }

    public function eiditthietbi()
    {
        $dichvus = Dichvu::all();
        return view('Menu.Thietbi.themthietbi', ['dichvus' => $dichvus]);
    }

    public function updateTB(Request $request, $ID_Tb)
    {
        $data = $request->validate([
            'code_Tb' => 'required',
            'Name_Tb' => 'required',
            'Diachi' => 'required',
            'dichvu_Sd' => 'required',
            'Loai_Tb' => 'required',
            'UserDN' => 'required',
            'password' => 'required',
        ]);

        $member = Member::where('UserDN', $data['UserDN'])->first();
        if (!$member) {
            return redirect('/Themthietbi')->with('error', 'Tài khoản không tồn tại');
        }

        $member->password = bcrypt($data['password']); // Sử dụng bcrypt() để tạo hash mật khẩu mới
        if (!password_verify($data['password'], $member->password)) {
            return redirect()->back()->with('error', 'Mật khẩu không đúng');
        }

        $thietbi = ThietBi::find($ID_Tb);
        $thietbi->code_Tb = $request->input('code_Tb');
        $thietbi->Name_Tb = $request->input('Name_Tb');
        $thietbi->Diachi = $request->input('Diachi');
        $thietbi->dichvu_Sd = $request->input('dichvu_Sd');
        $thietbi->Loai_Tb = $request->input('Loai_Tb');
        $thietbi->UserDN = $request->input('UserDN');
        $thietbi->password = $request->input('password');
        $thietbi->member_id = $member->MemberID;

        $this->createLog('Cập nhật thông tin thiết bị với mã số ' . $request->ID_Tb); // Gọi phương thức createLog và truyền tham số là tên thao tác

        $thietbi->save();
        return redirect('/Thietbi')->with('success', 'Cập nhật thiết bị thành công');
    }




    public function showthietbi(Request $request)
    {
        $query = ThietBi::query();
        $user = Auth::user();
        $keyword = $request->input('timkiem');
        if ($request->has('hoatdong')) {
            $hoatdong = $request->input('hoatdong');

            if ($hoatdong === 'Hoạt động') {
                $query->where('Tinhtrang', 'Hoạt động');
            } elseif ($hoatdong === 'Ngừng hoạt động') {
                $query->where('Tinhtrang', 'Ngừng hoạt động');
            } elseif ($hoatdong === 'Tất cả') {
                // Không áp dụng bất kỳ điều kiện lọc nào với trường Tinhtrang
            }
        }


        if ($keyword) {
            $keyword = $request->timkiem;
            $query->where('Name_Tb', 'like', "%$keyword%");
            $query->orwhere('code_Tb', 'like', "%$keyword%");
            $query->orwhere('Diachi', 'like', "%$keyword%");
        }

        if ($request->has('ketnoi')) {
            $ketnoi = $request->input('ketnoi');

            $user = Auth::user();
            if ($ketnoi === 'Kết nối') {
                $query->where('TT_ketnoi', 'Kết nối');
            } elseif ($ketnoi === 'Mất kết nối') {
                $query->where('TT_ketnoi',  'Mất kết nối');
            } elseif ($ketnoi === 'Tất cả') {
            }
        }
        // Số phần tử hiển thị trên mỗi trang
        $perPage = 10;

        // Lấy dữ liệu từ cơ sở dữ liệu sử dụng phân trang
        $thietbis = $query->paginate($perPage);



        $data = [
            'thietbis' => $thietbis,
            'timkiem' => $keyword,
        ];

        return view('Menu.Thietbi.thietbi', $data);
    }


    // Hàm showchitietTB

    public function showchitietTB($ID_Tb)
    {
        $thietbis = ThietBi::where('ID_Tb', (int)$ID_Tb)->first();
        return view('Menu/Thietbi/chitietTB', compact('thietbis'));
    }

    //    public function showchitietTB($ID_Tb)
    //    {
    //        $ID_Tb_sanitized = filter_var($ID_Tb, FILTER_SANITIZE_STRING);
    //        $thietbis = ThietBi::where('ID_Tb', floatval($ID_Tb_sanitized))->first();
    //        return view('Menu/Thietbi/chitietTB', compact('thietbis'));
    //    }


    //    $thietbis = ThietBi::where('ID_Tb', intval($ID_Tb))->first(); // hoặc ThietBi::where('ID_Tb', floatval($ID_Tb))->first();


    public function store(Request $request)
    {
        // Validate input data
        $data = $request->validate([
            'code_Tb' => 'required|unique:thietbi',
            'Name_Tb' => 'required',
            'Diachi' => 'required',
            'dichvu_Sd' => 'required',
            'Loai_Tb' => 'required',
            'UserDN' => 'required',
            'password' => 'required',
        ]);

        $member = member::all();
        $currentUserMemberID = Auth::user()->MemberID;
        // Find member by UserDN and password, or return error message
        $member = Member::where('UserDN', $data['UserDN'])->first();
        if (!$member) {
            return redirect('/Themthietbi')->with('error', 'Tài khoản không tồn tại');
        }
        if (!password_verify($data['password'], $member->password)) {
            return redirect('/Themthietbi')->with('error', 'Mật khẩu không đúng');
        }

        // Create new thietbi record with member_id
        $thietbi = new ThietBi($data);
        $thietbi->Tinhtrang = $member->Tinhtrang;
        $thietbi->member_id = $member->MemberID;
        $thietbi->UserDN = $member->UserDN;
        $thietbi->password = $member->password;

        if (is_array($thietbi->dichvu_Sd)) {
            $thietbi->dichvu_Sd = implode(', ', $thietbi->dichvu_Sd);
        }

        // Kiểm tra nếu member_id bằng với MemberID của người dùng hiện tại
        // Kiểm tra và cập nhật kết nối của thiết bị $thietbi
        $ketnoi = $thietbi->member_id == $currentUserMemberID ? 'Kết nối' : 'Mất kết nối';
        $thietbi->TT_ketnoi = $ketnoi;

        $this->createLog('Thêm 1 dịch vụ với mã số' . $request->ID_Tb);
        $thietbi->save();

        // Redirect to Themthietbi page with success message
        return redirect('/Thietbi')->with('success', 'Thêm thiết bị thành công');
    }






    public function forgot_Password(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:members'
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email hợp lệ',
            'email.exists' => 'Email này không tồn tại trong hệ thống'
        ]);

        $token = strtoupper(Str::random(10));
        $members = Member::where('Email', $req->email)->first();

        DB::table('password_reset_tokens')
            ->updateOrInsert(
                ['email' => $req->email],
                ['token' => $token]
            );


        $data = [
            'email' => $members->Email,
            'ten' => $members->MemberName,
            'token' => $token,
            'members' =>  $members,
            'ID' => $members->MemberID
        ];

        Mail::send('check_email_forget', $data, function ($email) use ($members) {
            $email->to($members->Email, $members->MemberName);
            $email->subject('MyShopping - Lấy lại mật khẩu tài khoản');
            $email->from('trunghhf@gmail.com');
        });


        return redirect()->route('login')->with('cuccess', 'Vui lòng kiểm tra email để thực hiện thay đổi mật khẩu')->with(compact('data'));
    }









    public function editgetPass(Request $request, Member $members, $email, $token)
    {
        $rspass = PassWordRS::where('token', $token)->where('email', $email)->first();
        $members = Member::where('Email', $request->email)->first();

        $data = [
            'email' => $email,
            'token' => $token,
            'members' =>  $members,

        ];
        if ($rspass) {
            return view('/getPass', compact('email', 'token', 'members'));
        }


        return abort(404);
    }




    public function getPass(Request $req, $email, $token)
    {
        $rspass = PassWordRS::where('token', $token)->where('email', $email)->first();

        if ($rspass) {
            $validator = Validator::make($req->all(), [
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);

            $members = Member::where('Email', $email)->first();

            $password = bcrypt($req->password);
            $members->password = $password;
            $members->save();

            return redirect()->route('login')->with('success', 'Thay đổi mật khẩu thành công, cám ơn');
        }

        return abort(404);
    }



    //hàm của trang
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function myMethod()
    {
        // Lưu trữ thông tin đăng nhập vào session
        $this->session->put('UserDN', 'UserDN');
        $this->session->put('password', 'password');

        // Truy xuất thông tin đăng nhập từ session
        $userDN = $this->session->get('UserDN');
        $password = $this->session->get('password');

        // Xóa thông tin đăng nhập từ session
        $this->session->forget('UserDN');
        $this->session->forget('password');
    }

    
    public function dangnhap(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'tenDN' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $credentials = [
            'UserDN' => $r->input('tenDN'),
            'password' => $r->input('password')
        ];

        if (Auth::attempt($credentials, true)) {
            $user = Auth::user();
            $r->session()->put('user', $user);
            if ($user->Nhom_A == 'QuanLyTaiKhoan') {
                return redirect('/quanlytaikhoan')->with('success', 'Đăng nhập thành công');
            }
            return redirect('/Dashboard')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect('/login')->with('error', 'Tên đăng nhập hoặc mật khẩu không chính xác')->withInput();
        }
    }


   



    // public function dangnhap(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'UserDN' => 'required|unique:members,"UserDN"',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::attempt($validatedData)) {
    //         return redirect('/taikhoancanhan');
    //     } else {
    //         return redirect('/login')->with('error', 'Tên đăng nhập hoặc mật khẩu không chính xác')->withInput();
    //     }

    // }
    // --------------------------------------------------------------



    /////////////////////////////

    /////////////////////////////////////////////
    public function dangkythanhvien(Request $r)
    {
        //dd($r->all());
        $messages = [];
        $validator = validator::make($r->all(), [
            'ten' => 'required',
            'tenDN' => 'required|unique:members,"UserDN"',
            'matkhau' => 'required',
            'sdt' => 'required|unique:members, "Tel"',
            'email' => 'required|unique:members, "Email"',
            'vaitro' => 'required',
            'Tinhtrang' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator)->withInput();
        }
        $tt = ['Ngưng hoạt động', 'Hoạt động',];
        $dv = ['Kế Toán', 'Lập Trình PHP ( Laravel )', 'Lập Trình backend', 'Lập Trình App Mobile'];
        $ten = $r->input('ten');
        $tenDN = $r->input('tenDN');
        $matkhau = bcrypt($r->input('matkhau')); // Mã hóa mật khẩu
        $sdt = $r->input('sdt');
        $email = $r->input('email');
        $vaitro    = $dv[$r->input('vaitro')];
        $Tinhtrang    = $tt[$r->input('Tinhtrang')];
        DB::insert('insert into members ( MemberName, UserDN, password, Tel, Email,Vaitro,Tinhtrang) values (?, ?, ?, ?, ?, ?, ? )', [$ten, $tenDN, $matkhau, $sdt, $email, $vaitro, $Tinhtrang]);

        return view('register', ['success' => 'Nhập thành công']);
    }


    // ---------------------------------------------------------------



 

    //Chức năng cập nhật tài khoản

    public function Capnhattaikhoan(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'ten' => 'required',
            'tenDN' => 'required|unique:members,"UserDN"',
            'matkhau' => 'required',
            'sdt' => 'required|unique:members, "Tel"',
            'email' => 'required|unique:members, "Email"',
            'diachi' => 'required',
            'vaitro' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/capnhattaikhoan')->withErrors($validator)->withInput();
        } else {
            // Update members table
            $dv = ['Kế Toán', 'Lập Trình PHP ( Laravel )', 'Lập Trình backend', 'Lập Trình App Mobile'];
            $ten = $r->input('ten');
            $tenDN = $r->input('tenDN');
            $matkhau = bcrypt($r->input('matkhau')); // Mã hóa mật khẩu
            $sdt = $r->input('sdt');
            $email = $r->input('email');
            $diachi = $r->input('diachi');
            $vaitro    = $dv[$r->input('vaitro')];

            // Get member by ID or post data
            $member = Member::findOrFail($r->input('id'));
            // $member = new Member();

            // Fill member properties
            $member->fill([
                'Ten' => $ten,
                'UserDN' => $tenDN,
                'password' => $matkhau,
                'Tel' => $sdt,
                'Email' => $email,
                'DiaChi' => $diachi,
                'VaiTro' => $vaitro,
            ]);

            // Save changes to database
            $member->save();

            // Redirect to success page
            return view('capnhattaikhoan', ['message' => 'Tài khoản ' . $member->UserDN . ' đã được cập nhật.']);
        }
    }


    //Hiển thị trang nhật ký người dùng


    //=================================================

    public function nhandi(Request $r)
    {
        dd($r->all());
    }
}
