<?php
/**
 * Created by PhpStorm.
 * User: Lany
 * Date: 2020/6/17
 * Time: 上午10:00
 */
namespace Lany\LaravelCurd;

use App\Handlers\ImageUpload;
use App\Models\Category;

use Illuminate\Http\Request;

trait CurdTrait
{
    public $stat;

    public function __construct()
    {
        parent::__construct();
        $this->stat = \Lany\LaravelCurd\Facade\ClassArr::initClass($this->type);
    }

    public function index()
    {
        $data = $this->stat->paginate();
        return view($this->bladePath.'.index', compact('data'));
    }

    public function create()
    {
        return view($this->bladePath . ".create", [$this->type => $this->stat]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        if ($request->bmi_image) {
            $upload = new ImageUpload();
            $result = $upload->upload($request->bmi_image, 'extends', \Auth::guard('admin')->id());
            $data['bmi_image'] = $result['path'];
        }
        $event = $this->stat->create($data);

        return $this->success('操作成功', route(ClassArr::$url[$this->type]));
    }

    public function delete(Request $request)
    {
        $result = $this->stat->find($request->route($this->type))->delete();
        if ($result) {
            return $this->success("删除成功", route(ClassArr::$url[$this->type]));
        } else {
            return $this->error("删除失败");
        }
    }

    public function edit(Request $request)
    {
        return view($this->bladePath . ".create", [$this->type => $this->stat->find($request->route($this->type))]);
    }

    public function update(Request $request)
    {
        $intances = $this->stat->find($request->route($this->type));
        $intances->update($request->except([
            '_token', '_method'
        ]));

        return $this->success('操作成功', route(ClassArr::$url[$this->type]));
    }
}

