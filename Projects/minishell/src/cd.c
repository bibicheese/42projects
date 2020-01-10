/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   cd.c                                               :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/19 13:30:08 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/23 15:43:11 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

static void		ft_error(char *bad, t_shell *shell)
{
	if (!access(bad, F_OK) && access(bad, X_OK) == -1)
	{
		ft_putstr_fd("cd: permission denied: ", 2);
		ft_putstr_fd(bad, 2);
		ft_putchar_fd('\n', 2);
		shell->error = 1;
	}
	else
	{
		ft_putstr_fd("cd: no such file or directory: ", 2);
		ft_putstr_fd(bad, 2);
		ft_putchar_fd('\n', 2);
		shell->error = 1;
	}
}

static void		cd_solo(t_shell *shell, char *oldpwd)
{
	int		i;

	i = -1;
	if (shell->env)
	{
		while (shell->lenv[++i])
		{
			if (!ft_strcmp(shell->lenv[i], "HOME"))
			{
				if (chdir(shell->renv[i]) == -1)
					ft_error(shell->renv[i], shell);
				else
					change_env(shell, oldpwd);
			}
		}
	}
}

void			ft_cd(char **args, t_shell *shell)
{
	char	oldpwd[1024];

	getcwd(oldpwd, 1024);
	if (!ft_strcmp(args[1], "-"))
	{
		ft_putendl(shell->oldpwd);
		chdir(shell->oldpwd);
		if (shell->env)
			change_env(shell, oldpwd);
	}
	else if (args[1])
	{
		if (chdir(args[1]) == -1)
			ft_error(args[1], shell);
		else
			change_env(shell, oldpwd);
	}
	else
		cd_solo(shell, oldpwd);
}

void			change_env(t_shell *shell, char *oldpwd)
{
	char	**newenv;
	char	pwd[1024];

	getcwd(pwd, 1024);
	ft_memdel((void **)&shell->oldpwd);
	shell->oldpwd = ft_strdup(oldpwd);
	if (!shell->env)
		newenv = newpwd(oldpwd, pwd);
	else
		newenv = replacepwd(shell, oldpwd, pwd);
	free_tab(shell->env);
	shell->env = array_cpy(newenv);
	free_tab(newenv);
	free_tab(shell->lenv);
	shell->lenv = lenv(shell->env);
}
