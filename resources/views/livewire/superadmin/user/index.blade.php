<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-user mr-1"></i>
                            {{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="dashboard">
                                    <i class="fas fa-home mr-1"></i>
                                    Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="fas fa-user mr-1"></i>
                                {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button wire:click="create" class="btn btn-primary" data-toggle="modal"
                                data-target="#createModal">
                                <i class="fas fa-plus mr-1"></i>
                                Tambah Data
                            </button>
                        </div>
                        <div class="btn-group dropleft">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-print mr-1"></i>
                                Cetak
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-success" href="#">
                                    <i class="fas fa-file-excel mr-1"></i>
                                    Excel
                                </a>
                                <a class="dropdown-item text-danger" href="#">
                                    <i class="fas fa-file-pdf mr-1"></i>
                                    PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-2">
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input wire:model.live="search" type="text" class="form-control"
                                placeholder="Pencarian...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-hover table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + $user->firstItem() - 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        @if ($item->role == 'Super Admin')
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $item->role }}
                                                </span>
                                            </td>
                                        @elseif ($item->role == 'Admin')
                                            <td>
                                                <span class="badge badge-secondary">
                                                    {{ $item->role }}
                                                </span>
                                            </td>
                                        @endif
                                        <td>
                                            <button class="btn btn-sm btn-warning mr-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $user->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
        {{-- create modal --}}
        @include('livewire.superadmin.user.create')
        {{-- create modal --}}
        {{-- close create modal --}}
        @script
            <script>
                $wire.on('closeCreateModal', () => {
                    $('#createModal').modal('hide');
                    Swal.fire({
                        title: "Sukses!",
                        text: "Data berhasil ditambahkan!",
                        icon: "success"
                    });
                });
            </script>
        @endscript
        {{-- close create modal --}}

    </div>

</div>
