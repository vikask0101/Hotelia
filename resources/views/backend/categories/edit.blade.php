<x-backend.layout :title="'Edit Category'">
    <x-slot:pageHeading>
        Edit Category
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit Category</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $category->position) }}" >
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
                                    <input type="checkbox" {{ $category->status == 'active' ? 'checked' : '' }} name="status" value="active">
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-backend.layout>
