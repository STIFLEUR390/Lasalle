<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="input-group input-group-sm">
                <input type="text" wire:model='search' style="width: 150px;" class="form-control"
                    placeholder="@lang('Search')">
                <select wire:model='oderBy' class="mx-1 custom-select rounded-0">
                    <option value="desc">@lang('From newest to oldest')</option>
                    <option value="asc">@lang('From oldest to newest')</option>
                </select>
                <select wire:model='search_role' class="mx-1 custom-select rounded-0">
                    <option value="">@lang('Select role')</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
                <select wire:model='pageSize' class="mx-1 custom-select rounded-0">
                    <option value="5">5</option>
                    <option value="7">7</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                @role('Super Admin')
                    <div class="float-right ml-1">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">@lang('Add user')</a>
                    </div>
                @endrole

            </div>
        </div>
        <div class="p-0 card-body table-responsive">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>@lang("Photo")</th>
                        <th>@lang('Name')</th>
                        <th>@lang("Email")</th>
                        <th>@lang("Role")</th>
                        <th>@lang("Create the")</th>
                        @role('Super Admin')
                            <th>@lang('Action')</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if ($user->deleted_at)
                            <tr class="bg-secondary">
                                <td>
                                    <img src="{{ asset($user->img) }}" alt="{{ $user->name }}" style="width: 70px;">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()[0] }}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                                @role('Super Admin')
                                    <td>
                                        <button type="button" class="ml-1 btn btn-info" wire:click="restorUser('{{ $user->id }}')">
                                            {{-- <i class="fa fa-undo"></i> --}}
                                            <i class="fa fa-trash-restore"></i>
                                        </button>
                                        <button type="button" class="ml-1 btn btn-danger" wire:click="confirmDeletion('{{ $user->id }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                @endrole
                            </tr>
                        @else
                            <tr>
                                <td>
                                    <img src="{{ asset($user->img) }}" alt="{{ $user->name }}" style="width: 70px;">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()[0] }}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                                @role('Super Admin')
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        <button type="button" class="ml-1 btn btn-warning"
                                            wire:click="destroyUser('{{ $user->id }}')"><i
                                                class="fa fa-user-times"></i></button>
                                    </td>
                                @endrole
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <span class="float-right mr-2">
                {{ $users->links() }}
            </span>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
