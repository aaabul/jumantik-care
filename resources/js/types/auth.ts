export type User = {
    id: string;
    name: string;
    email?: string;
    avatar?: string;
    email_verified_at: string | null;
    two_factor_enabled?: boolean;
    created_at: string;
    updated_at?: string;
    role?: string;
    wilayah_id?: number | null;
    rw_id?: number | null;
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};

export type Passkey = {
    id: string;
    name: string;
    authenticator: string | null;
    created_at_diff: string;
    last_used_at_diff: string | null;
};

export type TwoFactorConfigContent = {
    title: string;
    description: string;
    buttonText: string;
};
