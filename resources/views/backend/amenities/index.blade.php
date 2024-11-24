<x-backend.layout :title="'Amenities'">
    <x-slot:pageHeading>
        Amenities DataTable
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
                        <button class="btn btn-primary" onclick="window.location.href='{{ route('admin.rooms.amenities.create') }}'">Create</button>
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
                                @foreach($amenities as $amenity)
                                <tr>
                                    <td>{{ $amenity->id }}</td>
                                    <td>{{ $amenity->name }}</td>
                                    <td>{{ $amenity->position }}</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" {{ $amenity->status == 'active' ? 'checked' : '' }} disabled>
                                                <span class="lever"></span>
                                                {{ $amenity->status }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Actions <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('admin.rooms.amenities.edit', $amenity->id) }}">Edit</a></li>
                                                <li>
                                                    <form action="{{ route('admin.rooms.amenities.destroy', $amenity->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link">Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a href="#" onclick="event.preventDefault(); document.getElementById('status-form-{{ $amenity->id }}').submit()">Change Status</a>
                                                    <form id="status-form-{{ $amenity->id }}" action="{{ route('admin.rooms.amenities.update.status', $amenity->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="{{ $amenity->status == 'active' ? 'inactive' : 'active' }}">
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
