<div class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-heading">
                    <h2>Get product updates</h2>
                    <span>Subscribe to hear about new arrivals.</span>
                </div>
                @unless (config('demo.enabled'))
                <form id="subscribe" action="{{ route('send') }}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-lg-5">
                        <fieldset>
                          <input name="name" type="text" id="name" placeholder="Your Name" required="">
                        </fieldset>
                      </div>
                      <div class="col-lg-5">
                        <fieldset>
                          <input name="email" type="email" id="email" placeholder="Your Email Address" required>
                        </fieldset>
                      </div>
                      <div class="col-lg-2">
                        <fieldset>
                          <button type="submit" id="form-submit" class="main-dark-button"><i class="fa fa-paper-plane"></i></button>
                        </fieldset>
                      </div>
                    </div>
                </form>
                @else
                    <p>Subscriptions are disabled in this demo.</p>
                @endunless
            </div>
        </div>
    </div>
</div>
