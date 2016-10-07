@@extends('admin.master')

@@section('page-title')
    {{ trans('resource.' . $name) }}管理
    @@endsection

@@section('page-sub-title')
    创建{{ trans('resource.' . $name) }}
@@endsection


@@section('content')
    <div class="wrapper">
        <div class="panel">
            <div class="panel-heading">
                创建{{ trans('resource.' . $name) }}
                <span class="tools pull-right"><a class="t-collapse fa fa-chevron-down" href="javascript:;"></a></span>
            </div>
            <div class="panel-body">
                <form action="/{{ str_plural($name) }}" method="post">
                    <?php echo  "{!! csrf_field() !!}\n"; ?>
                        <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <button class="btn btn-success">创建</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@@endsection