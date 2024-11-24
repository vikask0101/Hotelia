<x-backend.layout :title="'Create Amenity'">
    <x-slot:pageHeading>
        Create Amenity
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Create Amenity</h5>
                </div>
                <div class="ibox-content">
                    <x-backend.alert />

                    <form action="{{ route('admin.rooms.amenities.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" id="position" name="position" class="form-control @error('position') is-invalid @enderror" >
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked name="status" value="active">
                                    <span class="lever"></span>
                                    Active
                                </label>
                            </div>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-backend.layout>
