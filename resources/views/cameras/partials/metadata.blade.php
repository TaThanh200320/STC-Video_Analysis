<div class="col-span-9">
    <h5>Metadata</h5>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value=""
                placeholder="MKK052 Pano 7000" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-span-4">
            <label for="locationId" class="form-label">Location</label>
            <x-hierarchical-select :areas="$areas" />
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
            <select name="groupId" class="form-control" aria-label="Default select example">
                <option value="">Select camera group</option>
                <option disabled class="text-gray-400">Area Group</option>
                @foreach ($groups as $group)
                    @if ($group->loainhom == 'chucnang')
                        @continue
                    @endif
                    <option value="{{ $group->id }}">
                        {{ $group->ten }}
                    </option>
                @endforeach
                <hr>
                <option disabled class="text-gray-400">Function Group</option>
                @foreach ($groups as $group)
                    @if ($group->loainhom == 'khuvuc')
                        @continue
                    @endif
                    <option class="!pl-[10px]" value="{{ $group->id }}">{{ $group->ten }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please select a valid group.
            </div>
        </div>
        <div class="col-span-4">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option selected disabled value="">Choose...</option>
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
</div>
