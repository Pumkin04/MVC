@extends('admin.layout')
@section('title', 'Chi tiết liên hệ')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Chi tiết lời nhắn</h5>
                        <a href="/contact/Contact" class="btn btn-sm btn-outline-light">Quay lại</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-sm-3 fw-bold text-muted">Người gửi:</div>
                            <div class="col-sm-9 h6 mb-0">{{ $contact['full_name'] }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 fw-bold text-muted">Email:</div>
                            <div class="col-sm-9"><a href="mailto:{{ $contact['email'] }}" class="text-decoration-none">{{ $contact['email'] }}</a></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 fw-bold text-muted">Số điện thoại:</div>
                            <div class="col-sm-9">{{ $contact['phone'] }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 fw-bold text-muted">Chủ đề:</div>
                            <div class="col-sm-9 fw-semibold">{{ $contact['subject'] }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 fw-bold text-muted">Ngày gửi:</div>
                            <div class="col-sm-9 text-muted small">{{ date('d/m/Y H:i:s', strtotime($contact['created_at'])) }}</div>
                        </div>
                        <hr class="my-4">
                        <div class="mb-3">
                            <div class="fw-bold text-muted mb-2">Lời nhắn:</div>
                            <div class="bg-light p-3 rounded" style="white-space: pre-wrap;">{{ $contact['message'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
