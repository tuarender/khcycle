@extends('admin.admin')
@section('adminContent')
    @include('admin.partials.adminSubHeader')
    <div class="adminContainer">
        <div class="membercontainer">
            {{--{{$name}}--}}
            {{--<hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>--}}

            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }}<a href="logout">ออกจากระบบ</a>
            </div>

            <div class="container">
                <form class="form-horizontal" role="form" method="post" action="admin/branch">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group @if ($errors->has('BRANCH_ZONE')) has-error @endif">
                        <label for="url" class="col-sm-3 control-label"><font color="red">*</font>Zone :</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="BRANCH_ZONE">
                                <option selected disabled>--Please Select Zone--</option>
                                @foreach($zone as $sz)
                                    <option value="{{$sz['ID']}}">{{$sz['ZONE_NAME']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btnKhcycle">
                            SEARCH
                        </button>

                    </div>
                </form>
            </div>

            <div class="container">
                @include('partials.flashmessage')
                <div class="row" style="text-align: right;">
                    <div class="col-xs-12">
                     <a type="button" href="admin/branch/export" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export</a>
                     <a type="button" href="admin/branch/edit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> เพิ่ม SHOP</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover tableAdmin">
                        <thead>
                        <tr class="tableHeader">
                            <th width="10%" class="tdCenter">ZONE NAME</th>
                            <th width="20%" class="tdCenter">BRANCH SHOP</th>
                            <th width="30%" class="tdCenter">BRANCH ADDR</th>
                            <th width="20%" class="tdcenter">BRANDS</th>
                            <th width="20%" class="tdCenter">การจัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $branch)
                        <tr>
                            <td class="tdCenter">{{$branch['ZONE_NAME']}}</td>
                            <td class="tdCenter">{{$branch['BRANCH_SHOP']}}</td>
                            <td class="tdCenter">{{$branch['BRANCH_ADDR']}}</td>
                            <td class="tdcenter">
                                <?php
                                    $my_ar = array($branch['BRANCH_BRAND_01'],$branch['BRANCH_BRAND_02'],$branch['BRANCH_BRAND_03'],$branch['BRANCH_BRAND_04'],$branch['BRANCH_BRAND_05'],
                                $branch['BRANCH_BRAND_06'],$branch['BRANCH_BRAND_07'],$branch['BRANCH_BRAND_08'],$branch['BRANCH_BRAND_09'],$branch['BRANCH_BRAND_10']);
                                    $my_ar= array_filter($my_ar);
                                    $my_ar = implode(',',$my_ar);
                                    print_r($my_ar)
                                ?>
                            </td>
                            <td class="tdCenter">
                                <div class='btn-group' role='group'>
                                    <a class="btn btn-warning" href="admin/branch/edit/{{$branch['BRANCH_ID']}}"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> EDIT</a>
                                    <a class="btn btn-danger" href='#' data-href="admin/branch/delete/{{$branch['BRANCH_ID']}}"  data-toggle='modal' data-target='#confirm-delete'>
                                        <span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> DELETE</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! str_replace('/?', '?', $data->render()) !!}
                </div>
            </div>
        </div>
    </div>
@endsection