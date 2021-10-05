@extends('layouts.app')



@section('title', 'Subjects')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <div class="content">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header table-card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h3 class="card-title table-card-title">Subjects Listing</h3>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="" class="btn btn-primary btn-small" id="addNewSubject" data-toggle="modal"
                                            data-target="#modalAddSubjectForm">Add Subject</a>
                                            <a href="{{route('subject.generatePDF')}}" class="btn btn-info btn-small" id="" >Generate Subjects PDF</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive table-box">
                                <div class="table-box-card">
                                    <table
                                        data-route="{{route('subject.list')}}"
                                        delete-route="{{route('subject.delete',['id' => ':id'])}}"
                                        id="subject_list"
                                        class="table table-bordered table-hover dataTable mlaTable"
                                        get-subject-route="{{route('subject.getSubject',['id' => ':id'])}}"
                                        >
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-box-card -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
            </section>
        </div>
    </div>

    {{-- Add Subject Model --}}
    @include('subject.add')

    {{-- View Subject Model --}}
    @include('subject.view')

    {{-- Edit Subject Model --}}
    @include('subject.edit')

@endsection

@push('scripts')
    <script src="{{ mix('js/subject.js') }}" type="text/javascript"></script>

@endpush
