@php
    $prevDate = null;
    $currentDate = null;
@endphp

@foreach($notifications as $notification)
    @php
        
        $notificationDateTime = \Carbon\Carbon::parse($notification->created_at);        
        $notificationDate = $notificationDateTime->format('Y-m-d');
        $notificationTime = $notificationDateTime->format('H:i');
        
        
        if ($currentDate !== $notificationDate) 
        {           
            $currentDate = $notificationDate;
                    
            $heading = ($currentDate === now()->format('Y-m-d')) ? 'Today' : (now()->subDay()->format('Y-m-d') === $currentDate ? 'Yesterday' : $currentDate);            
            
            echo '<h5 class="text-muted font-13 fw-normal mt-3">' . $heading . '</h5>';
        }
    @endphp
@if($userrole == 1 || $userrole == 2)
<a href="{{ route('admin.view_chat', 'id='.$notification->message_id) }}" class="dropdown-item notify-item mark_read mark_read_{{ $notification->id }}" data-id="{{ $notification->id }}" style="white-space: normal !important;">
                          
@else

<a href="{{ route('user.view_chat', 'id='.$notification->message_id) }}" class="dropdown-item notify-item mark_read mark_read_{{ $notification->message_id }}" data-id="{{ $notification->message_id }}" style="white-space: normal !important;">
@endif
    <div class="notify-icon bg-primary">
        <i class="mdi mdi-ticket-confirmation-outline"></i>
    </div>
    <p class="notify-details" style="white-space: normal !important;">New message from  {{ $notification->first_name }} {{ $notification->last_name }}.
        <small class="text-muted">{{ date('d M Y, H:i', strtotime($notification->created_at)) }}</small>
    </p>
</a>
@endforeach
