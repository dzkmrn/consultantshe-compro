<?php
/**
 * What the admin panel can edit, described once.
 *
 * The admin UI, the database schema and the publisher all read this file rather
 * than each carrying their own copy of the field list. Adding a field is a one
 * line change here; the form, the validation, the save and the generated
 * content file all follow from it.
 *
 * Field types:
 *   text      single line
 *   textarea  multi-line prose
 *   list      one string per line, stored as an array
 *   pairs     "Heading | Body" per line, stored as a list of two-key arrays
 *   image     path under assets/ or uploads/, chosen from the media library
 *   icon      key from includes/icons.php
 *   number    integer or decimal
 *   bool      checkbox
 *   choice    fixed set of values
 */

/**
 * Repeatable content: the things there can be many of, each its own row.
 *
 * 'publishes' is the content file the collection generates, and 'shape' is the
 * callback that turns a database row back into exactly the array structure the
 * templates already expect. Keeping that shape identical is what lets the
 * public pages stay untouched.
 */
function content_collections(): array
{
    return [
        'services' => [
            'label'     => 'Services',
            'singular'  => 'Service',
            'table'     => 'services',
            'publishes' => 'services',
            'summary'   => 'title',
            'fields'    => [
                'title'  => ['type' => 'text', 'label' => 'Title', 'required' => true, 'max' => 200],
                'icon'   => ['type' => 'icon', 'label' => 'Icon', 'required' => true],
                'items'  => ['type' => 'list', 'label' => 'Bullet points', 'help' => 'One per line. Split a single bullet across lines by ending a line with a backslash.'],
                'topics' => ['type' => 'list', 'label' => 'Training topics', 'help' => 'Optional. When present the card pages through these instead of the bullets.'],
            ],
        ],

        'jobs' => [
            'label'     => 'Job openings',
            'singular'  => 'Job opening',
            'table'     => 'jobs',
            'publishes' => 'jobs',
            'summary'   => 'title',
            'fields'    => [
                'title'    => ['type' => 'text', 'label' => 'Job title', 'required' => true, 'max' => 200],
                'urgent'   => ['type' => 'bool', 'label' => 'Show "Urgently Hiring" badge'],
                'type'     => ['type' => 'text', 'label' => 'Employment type', 'max' => 80, 'placeholder' => 'Contract'],
                'location' => ['type' => 'text', 'label' => 'Location', 'max' => 160],
                'banner'   => ['type' => 'image', 'label' => 'Banner image'],
                'summary'  => ['type' => 'textarea', 'label' => 'Summary', 'rows' => 5],
                'quals'    => ['type' => 'pairs', 'label' => 'Qualifications', 'help' => 'One per line. Add chips after a pipe, separated by semicolons: Experience with: | Supervisors; Managers'],
            ],
        ],

        'partners' => [
            'label'     => 'Clients & partners',
            'singular'  => 'Client logo',
            'table'     => 'partners',
            'publishes' => 'partners',
            'summary'   => 'name',
            'fields'    => [
                'name' => ['type' => 'text', 'label' => 'Company name', 'required' => true, 'max' => 160, 'help' => 'Used as the logo alt text.'],
                'file' => ['type' => 'image', 'label' => 'Logo', 'required' => true],
            ],
        ],

        'centers' => [
            'label'     => 'Training centres',
            'singular'  => 'Training centre',
            'table'     => 'centers',
            'publishes' => 'centers',
            'summary'   => 'name',
            'fields'    => [
                'name'    => ['type' => 'text', 'label' => 'Centre name', 'required' => true, 'max' => 200],
                'image'   => ['type' => 'image', 'label' => 'Photo', 'required' => true],
                'alt'     => ['type' => 'text', 'label' => 'Photo description', 'max' => 255, 'help' => 'Read aloud by screen readers.'],
                'address' => ['type' => 'list', 'label' => 'Address', 'help' => 'One line per line.'],
            ],
        ],

        'map_pins' => [
            'label'     => 'Map locations',
            'singular'  => 'Map location',
            'table'     => 'map_pins',
            'publishes' => null,
            'summary'   => 'name',
            'fields'    => [
                'name'  => ['type' => 'text', 'label' => 'Place name', 'required' => true, 'max' => 120],
                'lat'   => ['type' => 'number', 'label' => 'Latitude', 'required' => true, 'step' => '0.0001'],
                'lng'   => ['type' => 'number', 'label' => 'Longitude', 'required' => true, 'step' => '0.0001'],
                'place' => ['type' => 'choice', 'label' => 'Label position', 'choices' => ['left' => 'Left', 'right' => 'Right', 'center' => 'Centre'], 'default' => 'right'],
                'dx'    => ['type' => 'number', 'label' => 'Label nudge across', 'step' => '0.01', 'default' => 0],
                'dy'    => ['type' => 'number', 'label' => 'Label nudge down', 'step' => '0.01', 'default' => 0],
            ],
        ],

        'gallery' => [
            'label'     => 'Gallery photos',
            'singular'  => 'Photo',
            'table'     => 'gallery_photos',
            'publishes' => 'gallery',
            'summary'   => 'caption',
            'fields'    => [
                'file'    => ['type' => 'image', 'label' => 'Photo', 'required' => true],
                'caption' => ['type' => 'text', 'label' => 'Caption', 'max' => 255, 'help' => 'Optional. Used as the alt text when present.'],
            ],
        ],
    ];
}

/**
 * Single-value content, grouped the way the admin menu presents it.
 *
 * Every default here is the literal the template used to contain. They are
 * repeated rather than referenced because the template still carries its own
 * copy as the fallback — if these two ever disagree the template wins, which is
 * the safe direction.
 */
function content_settings(): array
{
    return [
        'site' => [
            'label'  => 'Site details',
            'intro'  => 'Brand, contact details and the address shown across the site.',
            'fields' => [
                'site.name'              => ['type' => 'text', 'label' => 'Company name', 'default' => 'PT Jasa General Consultant SHE'],
                'site.short_name'        => ['type' => 'text', 'label' => 'Short name', 'default' => 'PT Jasa General ConsultantSHE'],
                'site.tagline'           => ['type' => 'text', 'label' => 'Tagline', 'default' => 'Building Safer Workplaces, Stronger Teams, and Better Operations'],
                'site.description'       => ['type' => 'textarea', 'label' => 'Description', 'rows' => 3, 'default' => 'PT Jasa General Consultant SHE helps organizations strengthen Safety, Health, and Environment practices through consulting, competency development, assessment, and procurement support.'],
                'site.email'             => ['type' => 'text', 'label' => 'Contact email', 'default' => 'generalconsultant@jasagenshe.com'],
                'site.careers_email'     => ['type' => 'text', 'label' => 'Careers email', 'default' => 'generalconsultant@jasagenshe.com'],
                'site.phone'             => ['type' => 'text', 'label' => 'Phone', 'default' => '+62 859 7755 5933'],
                'site.whatsapp'          => ['type' => 'text', 'label' => 'WhatsApp number', 'help' => 'Digits only, country code first, no plus sign.', 'default' => '6285977555933'],
                'site.whatsapp_template' => ['type' => 'textarea', 'label' => 'WhatsApp prefilled message', 'rows' => 3, 'default' => 'Halo PT Jasa General Consultant SHE, saya tertarik dengan layanan perusahaan Anda. Boleh minta informasi lebih lanjut?'],
                'site.instagram'         => ['type' => 'text', 'label' => 'Instagram handle', 'help' => 'Without the @.', 'default' => 'general_consultantshe'],
                'site.year_founded'      => ['type' => 'number', 'label' => 'Year founded', 'default' => 2018],
                'site.address_lines'     => ['type' => 'list', 'label' => 'Address', 'default' => ['Pamulang Permai 1 Blok CX01/10 no 1', 'Pamulang Barat - Tangerang Selatan']],
                'site.address.street'    => ['type' => 'text', 'label' => 'Street (for search engines)', 'default' => 'RA Premiere, Jl. Intan No.25 1, RT.1/RW.2'],
                'site.address.locality'  => ['type' => 'text', 'label' => 'City / district', 'default' => 'Cilandak Barat, Kec. Cilandak, Kota Jakarta Selatan'],
                'site.address.region'    => ['type' => 'text', 'label' => 'Province', 'default' => 'Daerah Khusus Ibukota Jakarta'],
                'site.address.postal'    => ['type' => 'text', 'label' => 'Postcode', 'default' => '12430'],
                'site.address.country'   => ['type' => 'text', 'label' => 'Country code', 'default' => 'ID'],
                'site.keywords'          => ['type' => 'list', 'label' => 'Search keywords', 'help' => 'Most important first.', 'default' => ['HSE Competency Assessment', 'SHE consultant Indonesia', 'competency assessment center', 'TUK LSP K3', 'safety leadership training', 'HSE training provider Jakarta', 'K3 consulting', 'safety health environment consultant']],
                'site.og_image'          => ['type' => 'image', 'label' => 'Sharing image', 'help' => '1200x630 works best.', 'default' => 'images/og-image.jpg'],
            ],
        ],

        'nav' => [
            'label'  => 'Navigation & footer',
            'intro'  => 'The main menu and the wording around it.',
            'fields' => [
                'nav.items'      => ['type' => 'pairs', 'label' => 'Menu items', 'help' => 'One per line as Label | URL. Use / for the home page.', 'default' => [['text' => 'Home', 'items' => ['/']], ['text' => 'About Us', 'items' => ['/#about']], ['text' => 'Services', 'items' => ['/#services']], ['text' => 'Career', 'items' => ['/careers']], ['text' => 'Contact', 'items' => ['/#contact']]]],
                'nav.cta'        => ['type' => 'text', 'label' => 'Menu button label', 'default' => 'Discuss Your SHE Needs'],
                'footer.rights'  => ['type' => 'text', 'label' => 'Copyright line', 'default' => 'All Rights Reserved.'],
                'cta.heading'    => ['type' => 'text', 'label' => 'Contact banner heading', 'default' => 'Let’s Discuss Your SHE Needs'],
                'cta.button'     => ['type' => 'text', 'label' => 'Contact banner button', 'default' => 'Start a Conversation'],
            ],
        ],

        'home' => [
            'label'  => 'Home page',
            'intro'  => 'Hero and section headings on the front page.',
            'fields' => [
                'home.hero.title'         => ['type' => 'textarea', 'label' => 'Hero heading', 'rows' => 2, 'default' => 'Building Safer Workplaces, Stronger Teams, and Better Operations'],
                'home.hero.lead'          => ['type' => 'textarea', 'label' => 'Hero paragraph', 'rows' => 3, 'default' => 'We help organizations strengthen Safety, Health, and Environment (SHE) practices through consulting, competency development, assessment, and procurement support.'],
                'home.hero.cta_primary'   => ['type' => 'text', 'label' => 'Hero button (primary)', 'default' => 'Discuss Your SHE Needs'],
                'home.hero.cta_secondary' => ['type' => 'text', 'label' => 'Hero button (secondary)', 'default' => 'Explore Our Services'],
                'home.services.heading'   => ['type' => 'text', 'label' => 'Services heading', 'default' => 'Our Services'],
                'home.services.footnote'  => ['type' => 'text', 'label' => 'Services footnote', 'default' => 'Need help choosing the right service?'],
                'home.services.cta'       => ['type' => 'text', 'label' => 'Services footnote button', 'default' => 'Talk to Our Team'],
                'home.partners.eyebrow'   => ['type' => 'text', 'label' => 'Clients eyebrow', 'default' => 'Trusted Across Industries'],
                'home.partners.heading'   => ['type' => 'text', 'label' => 'Clients heading', 'default' => 'Supporting Organizations Across Indonesia'],
                'home.gallery.cta'        => ['type' => 'text', 'label' => 'Gallery button', 'default' => 'View Full Gallery'],
                'home.presence.heading'   => ['type' => 'text', 'label' => 'Coverage heading', 'default' => 'Local Presence, Wider Support'],
                'home.presence.lead'      => ['type' => 'textarea', 'label' => 'Coverage paragraph', 'rows' => 3, 'default' => 'Our presence across multiple locations in Indonesia enables faster coordination, better access to local resources, and more responsive support for clients across regions and industries.'],
                'home.centers.heading'    => ['type' => 'text', 'label' => 'Training centres heading', 'default' => 'Our facilities'],
            ],
        ],

        'about' => [
            'label'  => 'About page',
            'intro'  => 'Story, vision, mission and values. The About block shared with the home page is edited separately.',
            'fields' => [
                'about.hero.title'      => ['type' => 'text', 'label' => 'Page heading', 'default' => 'About Us'],
                'about.story.heading'   => ['type' => 'text', 'label' => 'Story heading', 'default' => 'Our Story'],
                'about.story.body'      => ['type' => 'textarea', 'label' => 'Story opening paragraph', 'rows' => 3, 'default' => 'Established in 2018, PT Jasa General Consultant SHE has grown into a comprehensive SHE consulting, competency training, assessment, and procurement partner serving industries across Indonesia.'],
                'about.vision.heading'  => ['type' => 'text', 'label' => 'Vision heading', 'default' => 'Vision'],
                'about.vision.body'     => ['type' => 'textarea', 'label' => 'Vision', 'rows' => 4, 'default' => 'To be a trusted SHE partner recognized for delivering measurable impact on safety performance and workforce competency.'],
                'about.mission.heading' => ['type' => 'text', 'label' => 'Mission heading', 'default' => 'Mission'],
                'about.mission.items'   => ['type' => 'list', 'label' => 'Mission points', 'help' => 'One per line.', 'default' => [
                    'Deliver practical SHE consulting and management system development',
                    'Build safety behaviour and culture through quality training',
                    'Ensure workforce competency through professional assessment',
                    'Support operations with reliable SHE procurement',
                    'Build long-term partnerships based on trust and results',
                ]],
                'about.values.heading'  => ['type' => 'text', 'label' => 'Values heading', 'default' => 'Our Values'],
                'about.values.items'    => ['type' => 'pairs', 'label' => 'Values', 'help' => 'One per line as Name | Description.', 'default' => [
                    ['text' => 'Integrity', 'items' => ['We uphold the highest standards of honesty and ethical conduct in everything we do.']],
                    ['text' => 'Excellence', 'items' => ['We strive for excellence in delivery, client service, and professional standards.']],
                    ['text' => 'Impact', 'items' => ['We measure success by the real, tangible improvements we create for our clients.']],
                    ['text' => 'Collaboration', 'items' => ['We work alongside our clients as partners, not just service providers.']],
                ]],
            ],
        ],

        'services_page' => [
            'label'  => 'Services page',
            'fields' => [
                'services.hero.title'     => ['type' => 'text', 'label' => 'Page heading', 'default' => 'Our Services'],
                'services.hero.lead'      => ['type' => 'textarea', 'label' => 'Page subheading', 'rows' => 2, 'default' => 'Consulting, competency development, assessment, and procurement support'],
                'services.topics.heading' => ['type' => 'text', 'label' => 'Training topics heading', 'default' => 'Training Topics'],
            ],
        ],

        'clients_page' => [
            'label'  => 'Clients page',
            'fields' => [
                'clients.hero.title'      => ['type' => 'text', 'label' => 'Page heading', 'default' => 'Our Clients'],
                'clients.hero.lead'       => ['type' => 'textarea', 'label' => 'Page subheading', 'rows' => 2, 'default' => 'Supporting organizations across Indonesia since 2018'],
                'clients.trusted.heading' => ['type' => 'text', 'label' => 'Section heading', 'default' => 'Trusted Across Industries'],
                'clients.trusted.body'    => ['type' => 'textarea', 'label' => 'Section paragraph', 'rows' => 3, 'default' => 'We partner with organizations across high-risk sectors including oil & gas, mining, construction, manufacturing, energy, and transportation.'],
                'clients.sectors.heading' => ['type' => 'text', 'label' => 'Sectors heading', 'default' => 'Sectors We Serve'],
                'clients.industries'      => ['type' => 'list', 'label' => 'Sectors', 'help' => 'One per line.', 'default' => [
                    'Oil & Gas', 'Manufacturing', 'Mining & Energy', 'Construction',
                    'Healthcare', 'Education', 'Government', 'Transportation',
                ]],
            ],
        ],

        'careers_page' => [
            'label'  => 'Careers page',
            'fields' => [
                'careers.hero.title'       => ['type' => 'text', 'label' => 'Page heading', 'default' => 'Build Your Career. Help Shape Safer Workplaces.'],
                'careers.hero.lead'        => ['type' => 'textarea', 'label' => 'Page subheading', 'rows' => 3, 'default' => 'Join PT Jasa General ConsultantSHE and grow your career while contributing to safer, healthier, and more responsible workplaces across industries.'],
                'careers.hero.points'      => ['type' => 'list', 'label' => 'Hero bullets', 'help' => 'One per line.', 'default' => [
                    'Grow through real-world SHE projects',
                    'Learn from experienced industry professionals',
                    'Develop technical and professional skills',
                    'Work with teams across diverse industries',
                ]],
                'careers.hero.caption'     => ['type' => 'text', 'label' => 'Photo caption', 'default' => 'Grow with us, make an impact, and build a safer future as part of our team.'],
                'careers.explore.heading'  => ['type' => 'text', 'label' => 'Hero button', 'default' => 'Explore Career Opportunities'],
                'careers.openings.heading' => ['type' => 'text', 'label' => 'Openings heading', 'default' => 'Current Openings'],
                'careers.openings.lead'    => ['type' => 'textarea', 'label' => 'Openings paragraph', 'rows' => 2, 'default' => 'Explore our current career opportunities and find the role that fits your expertise.'],
                'careers.empty'            => ['type' => 'textarea', 'label' => 'Shown when there are no openings', 'rows' => 3, 'help' => 'Write {email} where the careers address should appear as a link.', 'default' => 'There are no openings at the moment. Send your CV to {email} and we will keep it on file for future roles.'],
            ],
        ],

        'contact_page' => [
            'label'  => 'Contact page',
            'fields' => [
                'contact.hero.title'    => ['type' => 'text', 'label' => 'Page heading', 'default' => 'Contact Us'],
                'contact.hero.lead'     => ['type' => 'text', 'label' => 'Page subheading', 'default' => 'Let’s start a conversation about your SHE needs'],
                'contact.intro.heading' => ['type' => 'text', 'label' => 'Form heading', 'default' => 'Get in Touch'],
                'contact.intro.body'    => ['type' => 'textarea', 'label' => 'Form intro', 'rows' => 2, 'default' => 'Ada pertanyaan tentang layanan kami atau butuh proposal khusus? Kami siap membantu.'],
                'contact.success'       => ['type' => 'textarea', 'label' => 'Message sent confirmation', 'rows' => 2, 'default' => 'Pesan Anda sudah terkirim. Kami akan segera menghubungi Anda.'],
            ],
        ],

        'gallery_page' => [
            'label'  => 'Gallery page',
            'fields' => [
                'gallery.hero.title' => ['type' => 'text', 'label' => 'Page heading', 'default' => 'Moments From the Field & Classroom'],
                'gallery.hero.lead'  => ['type' => 'textarea', 'label' => 'Page subheading', 'rows' => 2, 'default' => 'A look at our consulting sessions, competency assessments, and training programmes delivered across Indonesia.'],
                'gallery.empty'      => ['type' => 'text', 'label' => 'Shown when there are no photos', 'default' => 'Belum ada foto yang ditampilkan.'],
            ],
        ],

        'error_page' => [
            'label'  => 'Not found page',
            'fields' => [
                'error404.title' => ['type' => 'text', 'label' => 'Heading', 'default' => '404'],
                'error404.body'  => ['type' => 'text', 'label' => 'Message', 'default' => 'Halaman yang Anda cari tidak ditemukan.'],
                'error404.cta'   => ['type' => 'text', 'label' => 'Button', 'default' => 'Kembali ke Beranda'],
            ],
        ],

        'seo' => [
            'label'  => 'Search engine titles',
            'intro'  => 'What Google shows. Keep titles near 60 characters and descriptions near 160.',
            'fields' => [
                'seo.home.title'           => ['type' => 'text', 'label' => 'Home title', 'default' => 'PT Jasa General Consultant SHE - HSE Competency Assessment'],
                'seo.home.description'     => ['type' => 'textarea', 'label' => 'Home description', 'rows' => 3, 'default' => 'PT Jasa General Consultant SHE delivers HSE competency assessment, SHE consulting, competency training, and procurement support for industries across Indonesia.'],
                'seo.about.title'          => ['type' => 'text', 'label' => 'About title', 'default' => 'About Us - PT Jasa General Consultant SHE'],
                'seo.about.description'    => ['type' => 'textarea', 'label' => 'About description', 'rows' => 3, 'default' => 'PT Jasa General Consultant SHE is an Indonesian consultancy for HSE competency assessment, safety training, and Safety, Health, and Environment management.'],
                'seo.services.title'       => ['type' => 'text', 'label' => 'Services title', 'default' => 'Our Services - PT Jasa General Consultant SHE'],
                'seo.services.description' => ['type' => 'textarea', 'label' => 'Services description', 'rows' => 3, 'default' => 'HSE competency assessment, SHE consulting, competency development and training, and SHE procurement support from PT Jasa General Consultant SHE.'],
                'seo.clients.title'        => ['type' => 'text', 'label' => 'Clients title', 'default' => 'Our Clients - PT Jasa General Consultant SHE'],
                'seo.clients.description'  => ['type' => 'textarea', 'label' => 'Clients description', 'rows' => 3, 'default' => 'Companies that trust PT Jasa General Consultant SHE for HSE competency assessment, safety training, and SHE consulting across Indonesia.'],
                'seo.careers.title'        => ['type' => 'text', 'label' => 'Careers title', 'default' => 'Career - PT Jasa General Consultant SHE'],
                'seo.careers.description'  => ['type' => 'textarea', 'label' => 'Careers description', 'rows' => 3, 'default' => 'Open positions at PT Jasa General Consultant SHE. Build your career with a team of HSE competency assessment, safety leadership, and SHE training professionals.'],
                'seo.gallery.title'        => ['type' => 'text', 'label' => 'Gallery title', 'default' => 'Gallery - PT Jasa General Consultant SHE'],
                'seo.gallery.description'  => ['type' => 'textarea', 'label' => 'Gallery description', 'rows' => 3, 'default' => 'Documentation of HSE competency assessment, training, and consulting work by PT Jasa General Consultant SHE across Indonesia.'],
                'seo.contact.title'        => ['type' => 'text', 'label' => 'Contact title', 'default' => 'Contact Us - PT Jasa General Consultant SHE'],
                'seo.contact.description'  => ['type' => 'textarea', 'label' => 'Contact description', 'rows' => 3, 'default' => 'Talk to PT Jasa General Consultant SHE in Jakarta about HSE competency assessment, SHE consulting, and safety training for your operations.'],
            ],
        ],

        'about_block' => [
            'label'  => 'About section (home page)',
            'intro'  => 'The block that appears on both the home page and the About page.',
            'fields' => [
                'about_block.eyebrow'    => ['type' => 'text', 'label' => 'Eyebrow', 'default' => 'About Us'],
                'about_block.heading'    => ['type' => 'text', 'label' => 'Heading'],
                'about_block.pillars'    => ['type' => 'list', 'label' => 'Pillars', 'help' => 'One per line.'],
                'about_block.lead'       => ['type' => 'textarea', 'label' => 'Lead paragraph', 'rows' => 3],
                'about_block.paragraphs' => ['type' => 'list', 'label' => 'Paragraphs', 'help' => 'One paragraph per line.'],
                'about_block.portrait.image' => ['type' => 'image', 'label' => 'Portrait'],
                'about_block.portrait.name'  => ['type' => 'text', 'label' => 'Portrait name'],
                'about_block.portrait.role'  => ['type' => 'text', 'label' => 'Portrait role'],
            ],
        ],

        'map' => [
            'label'  => 'Map frame',
            'intro'  => 'The bounding box the Indonesia map is drawn inside. Only change these if pins sit in the wrong place.',
            'fields' => [
                'map.lng_min' => ['type' => 'number', 'label' => 'Longitude minimum', 'step' => '0.1', 'default' => 94.5],
                'map.lng_max' => ['type' => 'number', 'label' => 'Longitude maximum', 'step' => '0.1', 'default' => 141.5],
                'map.lat_min' => ['type' => 'number', 'label' => 'Latitude minimum', 'step' => '0.1', 'default' => -11.3],
                'map.lat_max' => ['type' => 'number', 'label' => 'Latitude maximum', 'step' => '0.1', 'default' => 6.3],
            ],
        ],
    ];
}

/** Every settings field, flattened to key => definition. */
function content_settings_fields(): array
{
    static $flat = null;

    if ($flat !== null) {
        return $flat;
    }

    $flat = [];
    foreach (content_settings() as $group) {
        foreach ($group['fields'] as $key => $field) {
            $flat[$key] = $field;
        }
    }

    return $flat;
}

/** One collection definition, or null when the name is not one of ours. */
function content_collection(string $name): ?array
{
    return content_collections()[$name] ?? null;
}
