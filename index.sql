    
    /*tbl_audit_trail*/
    
    CREATE INDEX INDEX1 ON tbl_audit_trail (audit_rfp_id);
    CREATE INDEX INDEX2 ON tbl_audit_trail (trail_user_id);
    CREATE INDEX INDEX3 ON tbl_audit_trail (trail_approver_id);

    
    /*tbl_center_hierarchy*/

    CREATE INDEX INDEX1 ON tbl_center_hierarchy (cost_center_id);
    CREATE INDEX INDEX2 ON tbl_center_hierarchy (approver_user_id);

    /*tbl_rfp*/

    CREATE INDEX INDEX1 ON tbl_rfp (rfp_bu_id);
    CREATE INDEX INDEX2 ON tbl_rfp (rfp_center_id);
    CREATE INDEX INDEX3 ON tbl_rfp (rfp_bu_id);
    CREATE INDEX INDEX4 ON tbl_rfp (rfp_center_id);
    CREATE INDEX INDEX5 ON tbl_rfp (requestor_user_id);
    CREATE INDEX INDEX6 ON tbl_rfp (action_user_id);
    CREATE INDEX INDEX7 ON tbl_rfp (ap_action_user_id);
    CREATE INDEX INDEX8 ON tbl_rfp (treasury_action_user_id);

    /*tbl_rfp_approver*/
    CREATE INDEX INDEX1 ON tbl_rfp_approver (rfp_approver_rfp_id);
    CREATE INDEX INDEX2 ON tbl_rfp_approver (approver_user_id);

    /*tbl_rfp_bill*/
    CREATE INDEX INDEX1 ON tbl_rfp_bill (rfp_id);
    CREATE INDEX INDEX2 ON tbl_rfp_bill (nature_id);
    
    /*tbl_rfp_center*/
    CREATE INDEX INDEX1 ON tbl_rfp_center (rfp_id);
    CREATE INDEX INDEX2 ON tbl_rfp_center (cost_center);

    /*tbl_rfp_payee*/
    CREATE INDEX INDEX1 ON tbl_rfp_payee (rfp_payee_rfp_id);
    CREATE INDEX INDEX2 ON tbl_rfp_payee (rfp_payee_payee_id);

    /*tbl_tag_approver*/
    CREATE INDEX INDEX1 ON tbl_tag_approver (tag_approver_rfp_id);
    CREATE INDEX INDEX2 ON tbl_tag_approver (tag_approver_approver_id);

    /*tbl_user_role*/
    CREATE INDEX INDEX1 ON tbl_user_role (user_role_user_id);
    CREATE INDEX INDEX2 ON tbl_user_role (user_role_role_id);

