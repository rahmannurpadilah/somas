@extends('admin.layout')
@section('content')
    <div class="kt-container-fixed">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justif-ceter gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Content Ideas
                    </h1>
                </div>
                <div class="flex items-center">
                    <button type="button" class="kt-btn kt-btn-primary" data-kt-drawer-toggle="#admin_drawer">
                        Admin Curation
                        <i class="ki-filled ki-search-list"></i>
                    </button>
                </div>
                {{-- <div class="flex items-center">
                    <div class="kt-menu flex-inline" data-kt-menu="true">
                        <div class="kt-menu-item" data-kt-menu-item-offset="0, 10px" data-kt-menu-item-placement="bottom-end"
                            data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown"
                            data-kt-menu-item-trigger="click">
                            <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                <i class="ki-filled ki-dots-vertical text-lg">
                                </i>
                            </button>
                            <div class="kt-menu-dropdown kt-menu-default w-full max-w-[175px]" data-kt-menu-dismiss="true">
                                <div class="kt-menu-item">
                                    <form method="POST" action="">
                                        @csrf
                                        <button type="button" class="kt-menu-link" data-kt-modal-toggle="#adminCurationModal">
                                            <span class="kt-menu-icon">
                                                <i class="ki-filled ki-search-list"></i>
                                            </span>
                                            <span class="kt-menu-title">
                                                Content Curation
                                            </span>
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- ORIGINAL CONTENT -->
            <div class="kt-card">
                <div class="kt-card-content lg:pt-9 lg:pb-7.5">

                    <!-- Title -->
                    <div class="flex flex-col gap-1 mb-4">
                        <h3 class="text-xl text-mono">Original Content</h3>
                        <a class="text-sm text-primary font-medium" href="#">
                            Original Url
                        </a>
                    </div>

                    <!-- Caption -->
                    <div class="flex items-start gap-2 text-sm text-secondary-foreground mb-3">
                        <i class="ki-filled ki-abstract-41 text-muted-foreground mt-0.5"></i>
                        <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis iusto quos eum hic
                            dolorum et debitis rerum. Consequatur ullam nulla nihil ratione, minus cumque ipsa explicabo!
                            Quidem voluptas veniam laudantium.</span>
                    </div>

                    <div class="flex items-start gap-2 text-sm text-secondary-foreground mb-6">
                        <i class="ki-filled ki-sms text-muted-foreground mt-0.5"></i>
                        <span>Likes: 100</span>
                    </div>
                    <div class="flex items-start gap-2 text-sm text-secondary-foreground mb-6">
                        <i class="ki-filled ki-sms text-muted-foreground mt-0.5"></i>
                        <span>Views: 2000</span>
                    </div>

                </div>

                <div class="kt-card-footer">
                    <a class="kt-btn kt-btn-outline w-full">
                        <i class="ki-filled ki-check-circle"></i>
                        -
                    </a>
                </div>
            </div>

            <!-- AI GENERATED CONTENT -->
            <div class="kt-card border-primary/20">
                <div class="kt-card-content lg:pt-9 lg:pb-7.5">

                    <!-- Title -->
                    <div class="flex flex-col gap-1 mb-4">
                        <h3 class="text-xl text-mono">AI Generated Content</h3>
                        <span class="kt-badge kt-badge-sm kt-badge-success w-fit">
                            AI
                        </span>
                    </div>

                    <!-- Generated Caption -->
                    <div class="mb-5">
                        <p class="text-sm text-secondary-foreground leading-relaxed">
                            Boost your productivity with our latest AI-powered solution!
                            Designed to help you create, scale, and engage faster than ever.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="border-dashed border rounded-md px-3 py-2">
                            <span class="text-mono text-sm font-medium">ai generated script</span>
                            <div class="text-xs text-secondary-foreground">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Facilis voluptates nam nemo molestias magni, commodi consequuntur earum
                                quo. Ab doloremque ex commodi dolores perspiciatis? Provident dolores obcaecati nam!
                                Architecto, mollitia?</div>
                        </div>

                        <div class="border-dashed border rounded-md px-3 py-2">
                            <span class="text-mono text-sm font-medium">ai status</span>
                            <div class="text-xs text-secondary-foreground">Processing</div>
                        </div>
                        {{--
                <div class="border-dashed border rounded-md px-3 py-2">
                    <span class="text-mono text-sm font-medium">3s</span>
                    <div class="text-xs text-secondary-foreground">Gen Time</div>
                </div> --}}
                    </div>

                </div>

                <div class="kt-card-footer flex">
                    <a class="kt-btn kt-btn-primary w-full">Use Content</a>
                    {{-- <a class="kt-btn kt-btn-outline w-full">Regenerate</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Admin Curation Drawer -->
    <div class="hidden kt-drawer kt-drawer-end card flex-col max-w-[90%] w-[450px] top-5 bottom-5 end-5 rounded-xl border border-border"
        data-kt-drawer="true" data-kt-drawer-container="body" id="admin_drawer">

        <div class="flex items-center justify-between px-5 py-3.5 border-b border-border">
            <h3 class="text-sm font-semibold text-mono">Admin Curation</h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-dim" data-kt-drawer-dismiss="true">
                <i class="ki-filled ki-cross"></i>
            </button>
        </div>

        <form method="POST" action="" class="flex flex-col grow overflow-y-auto px-5 py-4 gap-4">
            @csrf

            <div>
                <label class="kt-form-label">Final Caption</label>
                <textarea name="final_caption" class="kt-textarea w-full" rows="3"></textarea>
            </div>

            <div>
                <label class="kt-form-label">Final Media Path</label>
                <input type="text" name="final_media_path" class="kt-input w-full" placeholder="/uploads/media.jpg">
            </div>

            <div>
                <label class="kt-form-label">Admin Notes</label>
                <textarea name="admin_notes" class="kt-textarea w-full" rows="2"></textarea>
            </div>

            <div>
                <label class="kt-form-label">Status</label>
                <select name="status" class="kt-select w-full">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" class="kt-btn kt-btn-outline" data-kt-drawer-dismiss="true">
                    Cancel
                </button>
                <button type="submit" class="kt-btn kt-btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
