<div class="grid grid-cols-12 gap-3">
    <div class="col-span-4">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="MKK052 Pano 7000"
            required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="path" class="form-label">Path</label>
        <input type="text" class="form-control" id="path" name="path" value=""
            placeholder="The end part of URL" required>
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
                        <option value="{{ $position->id }}">{{ $position->ten }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
    <div class="col-span-4">
        <label for="ipAddress" class="form-label">Ip address</label>
        <input type="text" class="form-control" id="ipAddress" name="ipAddress" value=""
            placeholder="192.168.8.191" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="port" class="form-label">Port</label>
        <input type="text" class="form-control" id="port" name="port" value="" placeholder="554"
            required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="" placeholder="admin"
            required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-span-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="" required>
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
                        <option value="{{ $group->id }}">{{ $group->ten }}</option>
                    @endif
                @endforeach
            </optgroup>
            <optgroup label="Function Group">
                @foreach ($groups as $group)
                    @if ($group->loainhom == 'chucnang')
                        <option value="{{ $group->id }}">{{ $group->ten }}</option>
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
            <option value="hoatdong">Run</option>
            <option value="ngunghoatdong">Stop</option>
            <option value="dacauhinh">Active</option>
            <option value="chuacauhinh">Inactive</option>
        </select>
        <div class="invalid-feedback">
            Please select a valid status.
        </div>
    </div>
</div>
