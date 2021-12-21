<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' יש לקבל את התכונה:. ',
    'active_url' => ' המאפיין: אינו כתובת URL חוקית. ',
    'after' => ' המאפיין: חייב להיות תאריך אחרי: תאריך. ',
    'after_or_equal' => ' המאפיין: חייב להיות תאריך אחרי או שווה ל: תאריך. ',
    'alpha' => ' התכונה: עשויה להכיל רק אותיות. ',
    'alpha_dash' => ' התכונה: עשויה להכיל רק אותיות, מספרים, מקפים וקווים תחתונים. ',
    'alpha_num' => ' התכונה: עשויה להכיל רק אותיות ומספרים. ',
    'array' => ' המאפיין: חייב להיות מערך. ',
    'before' => ' המאפיין: חייב להיות תאריך לפני: תאריך. ',
    'before_or_equal' => ' המאפיין: חייב להיות תאריך לפני או שווה ל: תאריך. ',
    'between' => [
        'numeric' => ' המאפיין: חייב להיות בין: min ל-: max.',
        'file' => ' המאפיין: חייב להיות בין: דקות ל: מקסימום קילובייט. ',
        'string' => ' המאפיין: חייב להיות בין: דקות ל: מקסימום תווים. ',
        'array' => ' המאפיין: חייב לכלול בין: min ו-: max פריטים. ',
    ],
    'boolean' => ' שדה התכונה חייב להיות נכון או שקר.       ',
    'confirmed' => ' אישור המאפיין: אינו תואם.  ',
    'date' => ' המאפיין: אינו תאריך חוקי. ',
    'date_equals' => ' המאפיין: חייב להיות תאריך השווה ל: תאריך.',
    'date_format' => ' המאפיין: אינו תואם לפורמט: פורמט.  ',
    'different' => ' התכונה: וכן: אחר חייב להיות שונה. ',
    'digits' => ' המאפיין: חייב להיות: ספרות ספרות. ',
    'digits_between' => ' המאפיין: חייב להיות בין: דקות לספרות מקסימליות. ',
    'dimensions' => ' למאפיין: יש ממדי תמונה לא חוקיים. ',
    'distinct' => ' לשדה: תכונה יש ערך כפול. ',
    'email' => ' המאפיין: חייב להיות כתובת דוא"ל תקפה. ',
    'ends_with' => ' המאפיין: חייב להסתיים באחת מהבאות: ערכים. ',
    'exists' => ' המאפיין שנבחר: אינו חוקי. ',
    'file' => ' המאפיין: חייב להיות קובץ.  ',
    'filled' => ' על שדה התכונה: להיות בעל ערך.  ',
    'gt' => [
        'numeric' => ' המאפיין: חייב להיות גדול מ: ערך.',
        'file' => ' המאפיין: חייב להיות גדול מ: ערך קילובייט.',
        'string' => 'המאפיין: חייב להיות גדול מ: תווי ערך.  ',
        'array' => ' המאפיין: חייב להכיל יותר מ: פריטי ערך.',
    ],
    'gte' => [
        'numeric' => 'התכונה: חייבת להיות גדולה או שווה: ערך.  ',
        'file' => 'המאפיין: חייב להיות גדול או שווה: קילובייט ערך.  ',
        'string' => 'המאפיין: חייב להיות גדול או שווה: תווי ערך.  ',
        'array' => 'המאפיין: חייב לכלול: פריטי ערך ומעלה.  ',
    ],
    'image' => 'המאפיין: חייב להיות תמונה.  ',
    'in' => ' המאפיין שנבחר: אינו חוקי.',
    'in_array' => 'שדה: התכונה אינו קיים ב: אחר.  ',
    'integer' => 'המאפיין: חייב להיות מספר שלם.  ',
    'ip' => 'המאפיין: חייב להיות כתובת IP חוקית.  ',
    'ipv4' => 'המאפיין: חייב להיות כתובת IPv4 תקפה.   ',
    'ipv6' => 'המאפיין: חייב להיות כתובת IPv6 תקפה.  ',
    'json' => '  המאפיין: חייב להיות מחרוזת json תקפה.',
    'lt' => [
        'numeric' => 'המאפיין: חייב להיות קטן מ-: ערך.   ',
        'file' => 'המאפיין: חייב להיות קטן מ: ערך קילובייט.   ',
        'string' => 'המאפיין: חייב להיות קטן מ: תווי ערך.   ',
        'array' => 'המאפיין: חייב לכלול פחות מ: פריטי ערך.    ',
    ],
    'lte' => [
        'numeric' => 'התכונה: חייבת להיות קטנה או שווה: ערך.     ',
        'file' => 'המאפיין: חייב להיות קטן או שווה: ערך קילובייט.   ',
        'string' => 'המאפיין: חייב להיות קטן או שווה: תווי ערך.    ',
        'array' => 'המאפיין: לא יכול להכיל יותר מ: פריטי ערך.   ',
    ],
    'max' => [
        'numeric' => 'המאפיין: לא יכול להיות גדול מ: מקסימום   ',
        'file' => 'המאפיין: לא יכול להיות גדול מ: מקסימום קילובייט.    ',
        'string' => 'המאפיין: לא יכול להיות גדול מ: מקסימום תווים.   ',
        'array' => 'התכונה: לא יכולה להכיל יותר מ: מקסימום פריטים.   ',
    ],
    'mimes' => 'המאפיין: חייב להיות קובץ מסוג: ערכים.   ',
    'mimetypes' => 'המאפיין: חייב להיות קובץ מסוג: ערכים.     ',
    'min' => [
        'numeric' => 'המאפיין: חייב להיות לפחות: דקות.    ',
        'file' => ' המאפיין: חייב להיות לפחות: דקות קילובייט. ',
        'string' => 'המאפיין: חייב להיות לפחות: תווים מינימום.  ',
        'array' => ' התכונה: חייבת להכיל לפחות: מיני פריטים.   ',
    ],
    'multiple_of' => ' המאפיין: חייב להיות מכפיל של: ערך  ',
    'not_in' => ' המאפיין שנבחר: אינו חוקי.  ',
    'not_regex' => ' פורמט התכונה: אינו חוקי.   ',
    'numeric' => ' המאפיין: חייב להיות מספר.      ',
    'password' => ' הסיסמא לא נכונה.   ',
    'present' => ' שדה התכונה חייב להיות נוכח.    ',
    'regex' => ' פורמט התכונה: אינו חוקי.  ',
    'required' => ' שדה המאפיין נדרש.    ',
    'required_if' => ' שדה התכונה נדרש כאשר: אחר הוא: ערך. ',
    'required_unless' => ' שדה התכונה נדרש אלא אם כן: אחר נמצא בערכים.   ',
    'required_with' => ' שדה התכונה נדרש כאשר: ערכים קיימים.         ',
    'required_with_all' => ' שדה התכונה נדרש כאשר קיימים ערכים.   ',
    'required_without' => ' שדה התכונה נדרש כאשר הערכים אינם קיימים.    ',
    'required_without_all' => ' שדה המאפיין נדרש כאשר אף אחד מהערכים אינו קיים.     ',
    'same' => ' התכונה: ו-: אחר חייב להתאים.  ',
    'size' => [
        'numeric' => ' המאפיין: חייב להיות: גודל.    ',
        'file' => ' המאפיין: חייב להיות: גודל קילובייט.   ',
        'string' => ' המאפיין: חייב להיות: תווים בגודל. ',
        'array' => ' המאפיין: חייב להכיל: פריטי גודל.   ',
    ],
    'starts_with' => ' המאפיין: חייב להתחיל באחת מהפעולות הבאות:: ערכים.      ',
    'string' => ' המאפיין: חייב להיות מחרוזת.     ',
    'timezone' => ' המאפיין: חייב להיות אזור תקף.               ',
    'unique' => ' התכונה: כבר נלקחה.               ',
    'uploaded' => ' העלאת התכונה: נכשלה.         ',
    'url' => ' פורמט התכונה: אינו חוקי.          ',
    'uuid' => ' המאפיין: חייב להיות UUID תקף.    ',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'email' => ['required' => ' ערך הדוא"ל נדרש.  '],
        'password' => ['required' => ' .ערך הסיסמה נדרש.  '],
        'first_name' => [
            'required' => ' .ערך השם הפרטי הנדרש.  ',
        ],
        'last_name' => [
            'required' => ' .ערך שם המשפחה הנדרש.  ',
        ],
        'password1' => [
            'required' => ' .ערך הסיסמה נדרש.  ',
            'min' => ' אורך הסיסמה צריך להיות לפחות 8.      ',
        ],
        'university' => [
            'required' => ' .אנא בחר באוניברסיטה.     ',
        ],
        'degree' => [
            'required' => ' אנא בחר את התואר. ',
        ],
        'terms' => [
            'required' => ' אנא קבל את התנאים וההגבלות להמשך. ',
        ],
        'email1' => [
            'required' => ' ערך הדוא"ל נדרש.  ',
            'unique' => ' דוא"ל משתמש זה כבר קיים. ',
            'email' => ' אנא הזן כתובת דוא"ל חוקית.  ',
        ],
        'profile_first_name' => [
            'required' => ' השם הפרטי נדרש.  ',
        ],
        'profile_last_name' => [
            'required' => ' שם המשפחה נדרש. ',
        ],
        'profile_email' => [
            'required' => ' ערך הדוא"ל נדרש. ',
            'email' => ' אנא הזן כתובת דוא"ל חוקית. ',
        ],
        'profile_phone_number' => [
            'required' => ' מספר הקשר נדרש. ',
        ],
        'old_password' => [
            'required' => ' אנא הזן סיסמה ישנה. ',
            'min' => ' אאורך הסיסמה צריך להיות לפחות 8. ',
        ],
        'new_password' => [
            'required' => ' אנא הזן סיסמה חדשה. ',
            'min' => ' אאורך הסיסמה צריך להיות לפחות 8.  ',
        ],
        'confirm_password' => [
            'required' => ' אנא אשר סיסמה חדשה. ',
            'same' => ' סיסמה לא מתאימה. ',
        ],
        'agree_terms' => [
            'required' => ' אנא אשר את התנאים וההגבלות. ',
        ],
        'risk_terms' => [
            'required' => ' אנא אשר את תנאי הסיכון.     ',
        ],
        'phone_number' => [
            'required' => ' אספר הקשר נדרש. ',
        ],
        'contact_name' => [
            'required' => ' .ערך השם הפרטי הנדרש. ',
        ],
        'contact_email' => [
            'required' => ' ארך הדוא"ל נדרש. ',
            'email' => ' אנא הזן כתובת דוא"ל חוקית.  ',
        ],
        'contact_radio' => [
            'required' => ' אנא בדוק לפחות אפשרות אחת   ',
        ],
        'contact_phone' => [
            'required' => ' מספר הקשר נדרש. ',
        ],
        'contact_comments' => [
            'required' => ' אנא הוסף הערות כאן. ',
        ],
        'phone1' => [
            'required' => ' אנא הכנס את מספר איש הקשר. ',
        ],
        'phone2' => [
            'required' => ' אנא הכנס את מספר איש הקשר. ',
        ],
        'address1' => [
            'required' => ' אנא הזן את הכתובת. ',
        ],
        'address2' => [
            'required' => ' אנא הזן את הכתובת. ',
        ],
        'instagram' => [
            'required' => ' אנא הכנס קישור לאינסטגרם. ',
        ],
        'facebook' => [
            'required' => ' אאנא הכנסו לקישור בפייסבוק. ',
        ],
        'youtube' => [
            'required' => ' אנא הכנסו לקישור YouTube. ',
        ],
        'longitude1' => [
            'required' => ' אנא הזן ערך אורך. ',
        ],
        'longitude2' => [
            'required' => ' אנא הזן ערך אורך. ',
        ],
        'latitude1' => [
            'required' => ' אנא הזן ערך רוחב. ',
        ],
        'latitude2' => [
            'required' => ' אנא הזן ערך רוחב. ',
        ],
        'add_coupon_name' => [
            'required' => ' נדרש שם קופון. ',
        ],
        'add_couponcode' => [
            'required' => ' נדרש קוד קופון. ',
        ],
        'add_discount' => [
            'required' => ' אנא הוסף ערך הנחה. ',
        ],
        'start_date' => [
            'required' => ' תאריך התחלה נדרש. ',
        ],
        'expired_date' => [
            'required' => ' תאריך תפוגה נדרש. ',
        ],
        'coupon_name' => [
            'required' => ' דרש שם קופון. ',
        ],
        'coupon_code' => [
            'required' => ' נדרש קוד קופון. ',
        ],
        'coupon_discount' => [
            'required' => ' אנא הוסף ערך הנחה. ',
        ],
        'admin_name' => [
            'required' => ' אנא הוסף שם ',
        ],
        'admin_email' => [
            'required' => ' נדרש שדה דוא"ל. ',
            'email' => ' אנא הזן כתובת דוא"ל חוקית.  ',
        ],
        'admin_phone' => [
            'required' => ' אנא הוסף מספר איש קשר. ',
        ],
        'address' => [
            'required' => ' נדרש שדה כתובת. ',
        ],
        'country' => [
            'required' => ' אנא בחר מדינה. ',
        ],
        'instructor_fname' => [
            'required' => ' נדרש שם פרטי. ',
        ],
        'instructor_lname' => [
            'required' => ' שם משפחה נדרש. ',
        ],
        'instructor_email' => [
            'required' => ' נדרש אימייל. ',
            'email' => ' אנא הזן כתובת דוא"ל חוקית.  ',
        ],
        'instructor_phoneno' => [
            'required' => ' נא הכנס את מספר איש הקשר. ',
        ],
        'addinst_university' => [
            'required' => ' אנא בחר באוניברסיטה. ',
        ],
        'addinst_degree' => [
            'required' => ' אנא בחר תואר. ',
        ],
        'instructor_destiny' => [
            'required' => ' אנא הוסף ייעוד מדריך. ',
        ],
        'instructor_address' => [
            'required' => ' אנא הוסף כתובת מדריך. ',
        ],
        'instructor_desc' => [
            'required' => ' אנא הוסף תיאור מדריך. ',
        ],
        'instructor_qualification' => [
            'required' => ' אנא הוסף הסמכת מדריך. ',
        ],
        'institute_name' => [
            'required' => ' אנא בחר את שם המכון. ',
        ],
        'adduser_fname' => [
            'required' => ' נדרש שם פרטי.  ',
        ],
        'adduser_lname' => [
            'required' => ' ם משפחה נדרש.  ',
        ],
        'adduser_email' => [
            'required' => ' נדרש אימייל. ',
            'email' => ' אנא הזן כתובת דוא"ל חוקית.  ',
        ],
        'adduser_phoneno' => [
            'required' => ' נא הוסף מספר איש קשר. ',
        ],
        'adduser_university' => [
            'required' => ' נא בחר את שם המכון. ',
        ],
        'adduser_degree' => [
            'required' => ' נא בחר תואר. ',
        ],
        'adduser_newpass' => [
            'required' => ' אנא הזן סיסמה חדשה. ',
            'min' => ' אאורך הסיסמה צריך להיות לפחות 8.  ',
        ],
        'adduser_confirmpass' => [
            'required' => ' אנא אשר סיסמה חדשה. ',
            'same' => ' סיסמה לא מתאימה. ',
        ],
        'user_name' => [
            'required' => ' דרש שם פרטי. ',
        ],
        'user_lname' => [
            'required' => '  משפחה נדרש.  ',
        ],
        'user_email' => [
            'required' => ' נדרש אימייל. ',
            'email' => ' אנא הזן כתובת דוא"ל חוקית.  ',
        ],
        'user_phone' => [
            'required' => ' נא הוסף מספר איש קשר.  ',
        ],
        'user_university' => [
            'required' => ' א בחר את שם המכון. ',
        ],
        'user_degree' => [
            'required' => ' א בחר תואר. ',
        ],
        'degree_name' => [
            'required' => ' אנא הוסף שם תואר. ',
        ],
        'texturl' => [
            'required' => ' אנא הזן כתובת אתר חוקית. ',
        ],
        'title' => [
            'required' => ' נדרש שדה כותרת. ',
        ],
        'startend' => [
            'required' => ' אנא הזן זמן קריאה. ',
        ],
        'category' => [
            'required' => ' אנא בחר ערך קטגוריה. ',
        ],
        'intro' => [
            'required' => ' אנא הכנס תיאור. ',
        ],
        'texthead' => [
            'required' => ' אנא הוסף פרטי תוכן בבלוג. ',
        ],
        'author' => [
            'required' => ' אנא בחר מחבר. ',
        ],
        'status' => [
            'required' => ' אנא הגדר ערך סטטוס. ',
        ],
        'references' => [
            'required' => ' אנא הוסף הפניות. ',
        ],
        'eventname' => [
            'required' => ' אנא הוסף את שם האירוע ',
        ],
        'zoomlink' => [
            'required' => ' אנא הוסף zoomlink ',
        ],
        'description' => [
            'required' => ' אנא הוסף תיאור ',
        ],
        'selected_date' => [
            'required' => ' אנא בחר תאריך אירוע ',
        ],
        'selected_time' => [
            'required' => ' אנא בחר זמן אירוע ',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
