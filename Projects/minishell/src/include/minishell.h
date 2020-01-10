/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   minishell.h                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/07/11 11:24:22 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/27 18:13:42 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef MINISHELL_H
# define MINISHELL_H

# include <stdio.h>
# include <stdlib.h>
# include <unistd.h>
# include "../libft/libft.h"

typedef struct			s_shell
{
	int					error;
	char				**env;
	char				**paths;
	char				**lenv;
	char				**renv;
	char				*oldpwd;
}						t_shell;

void					launch(char **args, t_shell *shell);
void					prompt(t_shell *shell);
char					**array_cpy(char **src);
char					*find_cmd(t_shell *shell, char *cmd);
t_shell					*init_shell(void);
char					**paths(char **env);
int						builtin(char **args, t_shell *shell);
int						cmd_exist(char *cmd);
void					ft_setenv(t_shell *shell, char **args);
void					ft_unsetenv(char **args, t_shell *shell);
char					**expansion(char **args, t_shell *shell);
char					**lenv(char **env);
char					**renv(char **env);
void					ft_cd(char **args, t_shell *shell);
char					**replacepwd(t_shell *shell, char *oldpwd, char *pwd);
char					**newpwd(char *oldpwd, char *pwd);
void					change_env(t_shell *shell, char *oldpwd);
void					free_tab(char **arr);
int						check_line(char *line);

#endif
