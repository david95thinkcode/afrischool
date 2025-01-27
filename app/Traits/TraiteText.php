<?php
 namespace App\Traits;

 trait TraiteText{
    
        /**
         * Get tel num without space.
         *
         * @param  number  $string
         * @return $copiest
         */
     function deleteSpace($string){
         //crée un  array des type d'espace
        $tabCar = array(" ", "\t", "\n", "\r", "\0", "\x0B", "\xA0");
        // retire les espace dans @$string
        $copiest = str_replace($tabCar, array(), $string);
        return $copiest;      	
    }

    function deleteIndicatif($string){

        $countrycode = ['+1', '+1242', '+1246', '+1264', '+1268', '+1284', '+1340', '+1345', '+1441', '+1473', '+1649', '+1664', '+1670', '+1671', '+1684', '+1721', '+1758', '+1767', '+1784', '+1787', '+1939', '+1809', '+1829', '+1849', '+1868', '+1869', '+1876',
        '+20', '+210', '+211', '+212', '+213', '+214', '+215', '+216', '+217', '+218', '+219', '+220', '+221', '+222', '+223', '+224', '+225', '+226', '+227', '+228', '+229', '+230', '+231', '+232', '+233', '+234', '+235', '+236', '+237', '+238', '+239', '+240',
        '+241', '+242', '+243', '+244', '+245', '+246', '+247', '+248', '+249', '+250', '+251', '+252', '+253', '+254', '+255', '+256', '+257', '+258', '+259', '+260', '+261', '+262', '+263', '+264', '+265', '+266', '+267', '+268', '+269', '+27', '+28', '+290', '+291', '+292', '+293', '+294', '+295', '+296', '+297', '+298', '+299',
        '+30', '+31', '+32', '+33', '+34', '+350', '+351', '+352', '+353', '+354', '+355', '+356', '+357', '+358', '+359', '+36', '+370', '+371', '+372', '+373', '+374', '+375', '+376', '+377', '+378', '+379', '+380', '+381', '+382', '+383', '+384', '+385', '+386', '+387', '+388', '+39',
        '+40', '+41', '+420', '+421', '+422', '+423', '+424', '+425', '+426', '+427', '+428', '+429', '+43', '+44', '+45', '+46', '+47', '+48', '+49', '+500', '+501', '+502', '+503', '+504', '+505', '+506', '+507', '+508', '+509', '+51', '+52', '+53', '+54', '+55', '+56', '+57', '+58',
        '+590', '+591', '+592', '+593', '+594', '+595', '+596', '+597', '+598', '+599', '+60', '+61',  '+62', '+63', '+64', '+65', '+66', '+670', '+671', '+672', '+673', '+674', '+675', '+676', '+677', '+678', '+679', '+680', '+681', '+682', '+683', '+684', '+685', '+686', '+687', '+688', '+689', '+690',
        '+691', '+692', '+693', '+694', '+695', '+696', '+697', '+698', '+699', '+7', '+81', '+82', '+83', '+84', '+850', '+851', '+852', '+853', '+854', '+855', '+856', '+857', '+858', '+859', '+86', '+880', '+886', '+90', '+91', '+92', '+93', '+94', '+95', '+960', '+961', '+962', '+963', '+964', '+965', '+966', '+967', '+968', '+969',
         '+970', '+971', '+972', '+973', '+974', '+975', '+976', '+977', '+978', '+979', '+98', '+990', '+991', '+992', '+993', '+994', '+995', '+996', '+997', '+998', '+999','001', '001242', '001246', '001264', '001268', '001284', '001340', '001345', '001441', '001473', '001649', '001664', '001670', '001671', '001684', '001721', '001758', '001767', '001784', '001787', '001939', '001809', '001829', '001849', '001868', '001869', '001876',
         '0020', '00210', '00211', '00212', '00213', '00214', '00215', '00216', '00217', '00218', '00219', '00220', '00221', '00222', '00223', '00224', '00225', '00226', '00227', '00228', '00229', '00230', '00231', '00232', '00233', '00234', '00235', '00236', '00237', '00238', '00239', '00240',
         '00241', '00242', '00243', '00244', '00245', '00246', '00247', '00248', '00249', '00250', '00251', '00252', '00253', '00254', '00255', '00256', '00257', '00258', '00259', '00260', '00261', '00262', '00263', '00264', '00265', '00266', '00267', '00268', '00269', '0027', '0028', '00290', '00291', '00292', '00293', '00294', '00295', '00296', '00297', '00298', '00299',
         '0030', '0031', '0032', '0033', '0034', '00350', '00351', '00352', '00353', '00354', '00355', '00356', '00357', '00358', '00359', '0036', '00370', '00371', '00372', '00373', '00374', '00375', '00376', '00377', '00378', '00379', '00380', '00381', '00382', '00383', '00384', '00385', '00386', '00387', '00388', '0039',
         '0040', '0041', '00420', '00421', '00422', '00423', '00424', '00425', '00426', '00427', '00428', '00429', '0043', '0044', '0045', '0046', '0047', '0048', '0049', '00500', '00501', '00502', '00503', '00504', '00505', '00506', '00507', '00508', '00509', '0051', '0052', '0053', '0054', '0055', '0056', '0057', '0058',
         '00590', '00591', '00592', '00593', '00594', '00595', '00596', '00597', '00598', '00599', '0060', '0061',  '0062', '0063', '0064', '0065', '0066', '00670', '00671', '00672', '00673', '00674', '00675', '00676', '00677', '00678', '00679', '00680', '00681', '00682', '00683', '00684', '00685', '00686', '00687', '00688', '00689', '00690',
         '00691', '00692', '00693', '00694', '00695', '00696', '00697', '00698', '00699', '007', '0081', '0082', '0083', '0084', '00850', '00851', '00852', '00853', '00854', '00855', '00856', '00857', '00858', '00859', '0086', '00880', '00886', '0090', '0091', '0092', '0093', '0094', '0095', '00960', '00961', '00962', '00963', '00964', '00965', '00966', '00967', '00968', '00969'];

        $out1 = preg_replace('/[^\+,0-9]/', '', $string);
        $out2 = preg_replace('/00/', '+', substr($out1, 0, 2)).substr($out1, 2);
        if(in_array(substr($out2, 0, 5), $countrycode, true))
        {
            $code=substr($out2, 0, 5);
            $nationalphone=substr($out2, 5);
        }
        elseif(in_array(substr($out2, 0, 4), $countrycode, true))
        {
            $nationalphone=substr($out2, 4);
        }
        elseif(in_array(substr($out2, 0, 3), $countrycode, true))
        {
            $nationalphone=substr($out2, 3);
        }
        elseif(in_array(substr($out2, 0, 2), $countrycode, true))
        {
            $nationalphone=substr($out2, 2);
        }
        else
        {
            $nationalphone=$out2;
        }
        if(substr($nationalphone,0,1) != '0')
        {
        $nationalphone = $nationalphone;
        }
        return $nationalphone;
    }
 }