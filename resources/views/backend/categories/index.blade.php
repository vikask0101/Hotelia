<x-backend.layout :title="'Categories'">
    <x-slot:pageHeading>
        Category DataTable
    </x-slot>
    @push('styles')
        <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet" />
    @endpush
    <div class="row">
        <div class="col-lg-12">
            <x-backend.alert />
            <div class="ibox">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <button class="btn btn-primary" onclick="window.location.href='{{ route('admin.categories.create') }}'">Create</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->position }}</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" {{ $category->status == 'active' ? 'checked' : '' }} disabled>
                                                <span class="lever"></span>
                                                {{ $category->status }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Actions <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a></li>
                                                <li>
                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link">Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a href="#" onclick="event.preventDefault(); document.getElementById('status-form-{{ $category->id }}').submit()">Change Status</a>
                                                    <form id="status-form-{{ $category->id }}" action="{{ route('admin.categories.update.status', $category->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="{{ $category->status == 'active' ? 'inactive' : 'active' }}">
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $(".dataTables-example").DataTable({
                pageLength: 25,
                responsive: true,
                });
            });
        </script>
    @endpush
</x-backend.layout>
