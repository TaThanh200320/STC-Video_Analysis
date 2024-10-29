<div class="grid grid-cols-12 gap-3">
    <div class="col-span-4">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $camera->ten }}"
            placeholder="MKK052 Pano 7000">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="locationId" class="form-label">Location</label>
        <select class="select2_search form-control" name="locationId">
            @foreach ($areas as $area)
                <optgroup label="{{ $area->ten }}">
                    @foreach ($area->positions as $position)
                        @if ($camera->position->id == $position->id)
                            <option selected value="{{ $camera->position->id }}">{{ $camera->position->ten }}</option>
                        @else
                            <option value="{{ $position->id }}">{{ $position->ten }}</option>
                        @endif
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
    <div class="col-span-4">
        <label for="path" class="form-label">Path</label>
        <input type="text" class="form-control" id="path" name="path" value="{{ $camera->duongdan }}"
            placeholder="The end part of URL">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="ipAddress" class="form-label">Ip address</label>
        <input type="text" class="form-control" id="ipAddress" name="ipAddress" value="{{ $camera->diachiip }}"
            placeholder="192.168.8.191">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="port" class="form-label">Port</label>
        <input type="text" class="form-control" id="port" name="port" value="{{ $camera->cong }}"
            placeholder="554">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $camera->tendangnhap }}"
            placeholder="admin">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="groupId" class="form-label">Group</label>
        <select class="select2_search form-control" name="groupId">
            <optgroup label="Area Group">
                @foreach ($groups as $group)
                    @if ($group->loainhom == 'khuvuc')
                        @if ($camera->group->id == $group->id)
                            <option selected value="{{ $camera->group->id }}">{{ $camera->group->ten }}</option>
                        @else
                            <option value="{{ $group->id }}">{{ $group->ten }}</option>
                        @endif
                    @endif
                @endforeach
            </optgroup>
            <optgroup label="Function Group">
                @foreach ($groups as $group)
                    @if ($group->loainhom == 'chucnang')
                        @if ($camera->group->id == $group->id)
                            <option selected value="{{ $camera->group->id }}">{{ $camera->group->ten }}</option>
                        @else
                            <option value="{{ $group->id }}">{{ $group->ten }}</option>
                        @endif
                    @endif
                @endforeach
            </optgroup>
        </select>
        <div class="invalid-feedback">
            Please select a valid group.
        </div>
    </div>
    <div class="col-span-4">
        <label for="status" class="form-label">Status</label>
        <select class="select2_search form-control" name="status">
            <option value="hoatdong" {{ $camera->trangthai == 'hoatdong' ? 'selected' : '' }}>Run</option>
            <option value="ngunghoatdong" {{ $camera->trangthai == 'ngunghoatdong' ? 'selected' : '' }}>Stop</option>
            <option value="dacauhinh" {{ $camera->trangthai == 'dacauhinh' ? 'selected' : '' }}>Active</option>
            <option value="chuacauhinh" {{ $camera->trangthai == 'chuacauhinh' ? 'selected' : '' }}>Inactive</option>
        </select>
        <div class="invalid-feedback">
            Please select a valid status.
        </div>
    </div>
</div>